<?php

namespace App\Services;

use HTMLPurifier;
use HTMLPurifier_Config;

/**
 * Service for sanitizing user-provided HTML content.
 *
 * Allows safe formatting tags (bold, italic, links, images, tables)
 * while stripping ALL event handlers and javascript: URIs.
 * This mitigates Stored XSS (CWE-79 / WEB-510025).
 */
class HtmlPurifierService
{
    private HTMLPurifier $purifier;

    public function __construct()
    {
        $config = HTMLPurifier_Config::createDefault();

        // Cache directory for HTMLPurifier's serialized definitions
        $cacheDir = storage_path('framework/cache/htmlpurifier');
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0755, true);
        }
        $config->set('Cache.SerializerPath', $cacheDir);

        // --- Allowed HTML elements ---
        $config->set('HTML.Allowed', implode(',', [
            // Text formatting
            'p', 'br', 'strong', 'em', 'u', 's', 'mark',
            // Headings
            'h2', 'h3', 'h4',
            // Lists
            'ul', 'ol', 'li',
            // Links (href only — no javascript:)
            'a[href|title|target]',
            // Images (src, alt only — no onerror/onload)
            'img[src|alt|width|height|class]',
            // Tables
            'table[class]', 'thead', 'tbody', 'tfoot', 'tr',
            'th[scope|colspan|rowspan]', 'td[colspan|rowspan]',
            // Misc
            'blockquote', 'pre', 'code', 'hr',
            'div[class]', 'span[class]',
        ]));

        // --- Block ALL javascript: URIs ---
        $config->set('URI.SafeIframeRegexp', null);
        $config->set('URI.AllowedSchemes', ['http' => true, 'https' => true, 'mailto' => false]);

        // --- Block dangerous attributes globally ---
        // HTMLPurifier already strips event handlers by default,
        // but we explicitly deny them for defence in depth.
        $config->set('HTML.ForbiddenAttributes', [
            // Block ALL on* event handlers
            'on*' => true,
        ]);

        // Allow target="_blank" on links but enforce noopener
        $config->set('HTML.TargetBlank', true);
        $config->set('HTML.TargetNoopener', true);

        $this->purifier = new HTMLPurifier($config);
    }

    /**
     * Sanitize HTML content, stripping XSS vectors while
     * preserving safe formatting elements.
     */
    public function purify(string $html): string
    {
        return $this->purifier->purify($html);
    }
}
