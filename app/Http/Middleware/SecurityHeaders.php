<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Adds security HTTP headers to every response and validates the Host header.
 *
 * Mitigates:
 * - WEB-679752 : Host Header Injection (CWE-20)
 * - WEB-9-1048 : Content-Security-Policy Header Not Set (CWE-693)
 * - WEB-453372 : Missing Anti-clickjacking Header (CWE-1021)
 * - WEB-760221 : X-Content-Type-Options Header Missing (CWE-693)
 */
class SecurityHeaders
{
    /**
     * Allowed hostnames — requests with any other Host header are rejected.
     * Pulled from APP_URL env so there's a single source of truth.
     *
     * @var string[]
     */
    private array $allowedHosts;

    public function __construct()
    {
        // Parse allowed host from APP_URL (e.g. https://bagian-organisasi.sv.padang.go.id)
        $appUrl   = config('app.url', 'http://localhost');
        $parsed   = parse_url($appUrl);
        $mainHost = $parsed['host'] ?? 'localhost';

        $this->allowedHosts = array_filter(array_map('trim', [
            $mainHost,
            'www.' . $mainHost,
            'localhost',        // local dev
            '127.0.0.1',       // local dev
            // Hardcode the known production domains in case APP_URL is not set correctly on the server
            'bagian-organisasi.sv.padang.go.id',
            'www.bagian-organisasi.sv.padang.go.id',
            // Allow direct IP access for deployment testing on port 8080
            '103.141.74.153'
        ]));
    }

    public function handle(Request $request, Closure $next): Response
    {
        // ── Host Header Validation ────────────────────────────────────────────
        // Only validate in production (APP_ENV=production) to avoid blocking
        // local dev testing (e.g. via artisan serve or Ngrok)
        if (app()->environment('production')) {
            $host = $request->getHost(); // strips port automatically
            if (!in_array($host, $this->allowedHosts, true)) {
                \Illuminate\Support\Facades\Log::error("Host Header Validation Failed. Received Host: '{$host}' - Allowed: " . implode(', ', $this->allowedHosts));
                abort(400, 'Invalid Host header.');
            }
        }

        $response = $next($request);

        // ── Security Headers ──────────────────────────────────────────────────

        // Content-Security-Policy
        // Allows: self, Alpine.js CDN, Phosphor Icons CDN, Google Fonts,
        // data: URIs for inline images (maps embeds etc.), blob: for file previews.
        // Blocks: inline event handlers via script-src 'unsafe-inline' is sadly
        // required by Alpine.js, but object-src/frame-src are locked down.
        $csp = implode('; ', [
            "default-src 'self'",
            "script-src 'self' cdn.jsdelivr.net 'unsafe-inline'",
            "style-src 'self' fonts.googleapis.com cdn.jsdelivr.net 'unsafe-inline'",
            "font-src 'self' fonts.gstatic.com cdn.jsdelivr.net data:",
            "img-src 'self' data: blob: images.unsplash.com *.padang.go.id",
            "connect-src 'self'",
            "frame-src 'self'",
            "frame-ancestors 'self'",  // replaces X-Frame-Options
            "object-src 'none'",
            "base-uri 'self'",
            "form-action 'self'",
        ]);

        $response->headers->set('Content-Security-Policy', $csp);

        // Anti-clickjacking (belt-and-suspenders alongside CSP frame-ancestors)
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Prevent MIME sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Referrer policy — don't leak full URL to third parties
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions policy — disable unused APIs
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=(), payment=()'
        );

        return $response;
    }
}
