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

    /**
     * Pengunjung bulan ini.
     */
    public static function getThisMonthVisitors(): int
    {
        return static::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->sum('unique_visitors');
    }

    /**
     * Pengunjung tahun ini.
     */
    public static function getThisYearVisitors(): int
    {
        return static::whereYear('date', now()->year)
            ->sum('unique_visitors');
    }

    /**
     * Data untuk chart kunjungan harian (Bulan Ini)
     */
    public static function getChartData(): array
    {
        $stats = static::whereMonth('date', now()->month)
            ->whereYear('date', now()->year)
            ->orderBy('date')
            ->get();

        $labels = [];
        $data = [];

        foreach ($stats as $stat) {
            $labels[] = \Carbon\Carbon::parse($stat->date)->format('d M');
            $data[] = $stat->unique_visitors;
        }

        return [
            'labels' => $labels,
            'data' => $data,
        ];
    }
}
