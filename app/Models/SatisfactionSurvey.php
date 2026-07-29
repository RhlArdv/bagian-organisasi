<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SatisfactionSurvey extends Model
{
    protected $fillable = [
        'title',
        'year',
        'period',
        'score',
        'predicate',
        'summary',
        'document_path',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'decimal:2',
            'year' => 'integer',
        ];
    }

    /**
     * Scope: urutkan terbaru.
     */
    public function scopeLatest($query)
    {
        return $query->orderByDesc('year')->orderByDesc('period');
    }
}
