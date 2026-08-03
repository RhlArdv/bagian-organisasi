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
     * Cari atau buat sesi obrolan berdasarkan kunci IP Address & Cookie/Token Pengguna.
     */
    public static function findOrCreateForVisitor(Request $request): self
    {
        $ip = $request->ip();
        $token = $request->cookie('live_chat_token');

        // Pertama cari berdasarkan token cookie jika ada
        if ($token) {
            $session = static::where('session_token', $token)->first();
            if ($session) {
                // Perbarui IP bila berubah namun token sama
                if ($session->ip_address !== $ip) {
                    $session->update(['ip_address' => $ip]);
                }
                return $session;
            }
        }

        // Kedua cari berdasarkan kunci IP Address yang masih aktif atau terbaru (kunci IP)
        $session = static::where('ip_address', $ip)
            ->where('status', 'open')
            ->latest('last_message_at')
            ->first();

        if ($session) {
            return $session;
        }

        // Jika belum ada sama sekali, buat sesi baru
        $newToken = Str::uuid()->toString();
        
        return static::create([
            'ip_address' => $ip,
            'session_token' => $newToken,
            'visitor_name' => 'Tamu (' . $ip . ')',
            'status' => 'open',
            'unread_admin' => 0,
            'unread_visitor' => 0,
            'last_message_at' => now(),
        ]);
    }
}
