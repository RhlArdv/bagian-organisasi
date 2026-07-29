<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $fillable = [
        'type',
        'ticket_number',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'attachment',
        'status',
        'reply_message',
        'replied_by',
        'replied_at',
    ];

    protected function casts(): array
    {
        return [
            'replied_at' => 'datetime',
        ];
    }

    /**
     * Admin yang membalas.
     */
    public function repliedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'replied_by');
    }

    /**
     * Generate ticket number otomatis.
     */
    public static function generateTicketNumber(string $type): string
    {
        $prefix = match ($type) {
            'kritik_saran' => 'KS',
            'pengaduan' => 'PD',
            'permohonan' => 'PM',
            default => 'FB',
        };

        $count = static::where('type', $type)->count() + 1;

        return $prefix . '-' . now()->format('Ymd') . '-' . str_pad($count, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Scope: filter berdasarkan type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type)->orderByDesc('created_at');
    }
}
