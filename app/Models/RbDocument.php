<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RbDocument extends Model
{
    protected $fillable = [
        'type',
        'title',
        'year',
        'description',
        'document_path',
        'score',
        'predicate',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'decimal:2',
            'year' => 'integer',
        ];
    }

    /**
     * Scope: filter berdasarkan type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type)->orderByDesc('year');
    }
}
