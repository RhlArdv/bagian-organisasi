<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceMetric extends Model
{
    protected $fillable = [
        'type',
        'year',
        'score',
        'predicate',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'score' => 'decimal:2',
            'year' => 'integer',
        ];
    }

    /**
     * Ambil metric terbaru berdasarkan type.
     */
    public function scopeLatestByType($query, string $type)
    {
        return $query->where('type', $type)->orderByDesc('year');
    }

    /**
     * Ambil semua metric terbaru (1 per type, tahun terbaru).
     */
    public static function getLatestAll()
    {
        return static::query()
            ->whereIn('id', function ($sub) {
                $sub->selectRaw('MAX(id)')
                    ->from('performance_metrics')
                    ->groupBy('type');
            })
            ->get()
            ->keyBy('type');
    }
}
