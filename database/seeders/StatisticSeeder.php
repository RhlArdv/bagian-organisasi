<?php

namespace Database\Seeders;

use App\Models\Statistic;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    public function run(): void
    {
        $statistics = [
            [
                'name' => 'Perangkat Daerah',
                'value' => '47',
                'icon' => 'ph-buildings',
                'color' => 'brand',
                'order' => 1,
            ],
            [
                'name' => 'ASN',
                'value' => '1.482',
                'icon' => 'ph-users',
                'color' => 'blue',
                'order' => 2,
            ],
            [
                'name' => 'SOP',
                'value' => '228',
                'icon' => 'ph-clipboard-text',
                'color' => 'green',
                'order' => 3,
            ],
            [
                'name' => 'Standar Pelayanan',
                'value' => '86',
                'icon' => 'ph-check-circle',
                'color' => 'purple',
                'order' => 4,
            ],
            [
                'name' => 'Indeks RB 2023',
                'value' => '81,25',
                'icon' => 'ph-chart-line-up',
                'color' => 'brand',
                'order' => 5,
            ],
        ];

        foreach ($statistics as $stat) {
            Statistic::updateOrCreate(
                ['name' => $stat['name']],
                $stat
            );
        }
    }
}
