<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'content',
        'attachment',
        'is_pinned',
        'is_active',
        'published_at',
        'expired_at',
    ];

    protected function casts(): array
    {
        return [
            'is_pinned' => 'boolean',
            'is_active' => 'boolean',
            'published_at' => 'date',
            'expired_at' => 'date',
        ];
    }

    /**
     * Scope: pengumuman aktif dan belum expired.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expired_at')
                  ->orWhere('expired_at', '>=', now());
            })
            ->orderByDesc('is_pinned')
            ->orderByDesc('published_at');
    }
}
