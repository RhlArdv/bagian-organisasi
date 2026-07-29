<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorStat extends Model
{
    protected $fillable = [
        'date',
        'page_views',
        'unique_visitors',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    /**
     * Increment page view untuk hari ini.
     */
    public static function recordVisit(bool $isUnique = false): void
    {
        $stat = static::firstOrCreate(
            ['date' => now()->toDateString()],
            ['page_views' => 0, 'unique_visitors' => 0]
        );

        $stat->increment('page_views');

        if ($isUnique) {
            $stat->increment('unique_visitors');
        }
    }

    /**
     * Total semua pengunjung.
     */
    public static function getTotalVisitors(): int
    {
        return static::sum('unique_visitors');
    }

    /**
     * Pengunjung hari ini.
     */
    public static function getTodayVisitors(): int
    {
        return static::where('date', now()->toDateString())->value('unique_visitors') ?? 0;
    }
}
