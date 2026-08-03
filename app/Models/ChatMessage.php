<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    protected $table = 'chat_messages';

    protected $fillable = [
        'chat_session_id',
        'sender_type',
        'user_id',
        'message',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'is_read' => 'boolean',
        ];
    }

    /**
     * Sesi obrolan pemilik pesan ini.
     */
    public function session(): BelongsTo
    {
        return $this->belongsTo(ChatSession::class, 'chat_session_id');
    }

    /**
     * Admin yang mengirim pesan (jika sender_type == 'admin').
     */
    public function senderAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Format waktu pengiriman untuk antarmuka pengguna.
     */
    public function getFormattedTimeAttribute(): string
    {
        return $this->created_at ? $this->created_at->format('H:i') : '';
    }
}
