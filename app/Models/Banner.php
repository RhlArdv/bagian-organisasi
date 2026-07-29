<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'button_text',
        'button_link',
        'is_active',
        'order_index',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    /**
     * Scope: hanya banner aktif, urut berdasarkan order_index.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order_index');
    }
}
