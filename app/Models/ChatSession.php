<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatSession extends Model
{
    protected $table = 'chat_sessions';

    protected $fillable = [
        'ip_address',
        'session_token',
        'visitor_name',
        'visitor_email',
        'visitor_phone',
        'status',
        'unread_admin',
        'unread_visitor',
        'last_message_at',
    ];

    protected function casts(): array
    {
        return [
            'last_message_at' => 'datetime',
        ];
    }

    /**
     * Seluruh pesan dalam sesi obrolan.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(ChatMessage::class, 'chat_session_id')->orderBy('created_at', 'asc');
    }

    /**
     * Pesan terakhir untuk tampilan list di admin.
     */
    public function latestMessage(): HasOne
    {
        return $this->hasOne(ChatMessage::class, 'chat_session_id')->latestOfMany();
    }

    /**
     * Cari sesi yang sudah ada berdasarkan Token Pengguna (Tanpa membuat baru).
     */
    public static function findForVisitor(Request $request): ?self
    {
        $token = $request->header('X-Chat-Token') ?: $request->cookie('live_chat_token');
        if (!empty($token)) {
            return static::where('session_token', $token)->first();
        }
        return null;
    }

    /**
     * Cari atau buat sesi obrolan berdasarkan Token Pengguna (Cookie / Header LocalStorage) secara eksklusif.
     */
    public static function findOrCreateForVisitor(Request $request): self
    {
        $ip = $request->ip();
        $session = static::findForVisitor($request);

        if ($session) {
            $updates = [];
            if ($session->ip_address !== $ip) {
                $updates['ip_address'] = $ip;
            }
            if ($request->filled('name') && $session->visitor_name !== $request->name) {
                $updates['visitor_name'] = strip_tags($request->name);
            }
            if ($request->filled('email') && $session->visitor_email !== $request->email) {
                $updates['visitor_email'] = strip_tags($request->email);
            }
            if ($request->filled('phone') && $session->visitor_phone !== $request->phone) {
                $updates['visitor_phone'] = strip_tags($request->phone);
            }
            if (!empty($updates)) {
                $session->update($updates);
            }
            return $session;
        }

        // Jika belum ada token yang cocok (laptop/browser baru), buat sesi independen baru dengan data onboarding
        $newToken = Str::uuid()->toString();
        $name = $request->filled('name') ? strip_tags($request->name) : 'Tamu (' . substr($newToken, 0, 8) . ')';
        
        return static::create([
            'ip_address' => $ip,
            'session_token' => $newToken,
            'visitor_name' => $name,
            'visitor_email' => $request->filled('email') ? strip_tags($request->email) : null,
            'visitor_phone' => $request->filled('phone') ? strip_tags($request->phone) : null,
            'status' => 'open',
            'unread_admin' => 0,
            'unread_visitor' => 0,
            'last_message_at' => now(),
        ]);
    }
}
