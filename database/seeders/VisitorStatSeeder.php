<?php

namespace Database\Seeders;

use App\Models\VisitorStat;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VisitorStatSeeder extends Seeder
{
    public function run(): void
    {
        // Generate dummy visitor stats for the past 30 days
        for ($i = 30; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            
            // Randomly generate some realistic looking traffic
            // More traffic on weekdays, less on weekends
            $isWeekend = Carbon::parse($date)->isWeekend();
            
            $baseUnique = $isWeekend ? rand(100, 300) : rand(300, 800);
            $basePageViews = $baseUnique * rand(15, 35) / 10; // Page views are 1.5x to 3.5x of unique visitors

            VisitorStat::updateOrCreate(
                ['date' => $date],
                [
                    'unique_visitors' => $baseUnique,
                    'page_views' => (int) $basePageViews
                ]
            );
        }
    }
}
