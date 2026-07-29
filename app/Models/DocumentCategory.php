<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'group',
        'order_index',
    ];

    /**
     * Dokumen dalam kategori ini.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(Document::class, 'category_id');
    }

    /**
     * Scope: filter berdasarkan group menu.
     */
    public function scopeByGroup($query, string $group)
    {
        return $query->where('group', $group)->orderBy('order_index');
    }
}
