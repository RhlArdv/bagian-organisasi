<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'order_index',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Scope: hanya FAQ aktif, urut berdasarkan order_index.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order_index');
    }
}
