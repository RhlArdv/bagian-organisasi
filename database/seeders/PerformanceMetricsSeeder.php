<?php

namespace Database\Seeders;

use App\Models\PerformanceMetric;
use Illuminate\Database\Seeder;

class PerformanceMetricsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metrics = [
            [
                'type' => 'NILAI_RB',
                'year' => 2023,
                'score' => 81.25,
                'predicate' => 'A',
                'description' => 'Indeks Reformasi Birokrasi Kota Padang Tahun 2023',
            ],
            [
                'type' => 'NILAI_SAKIP',
                'year' => 2023,
                'score' => 78.50,
                'predicate' => 'BB',
                'description' => 'Nilai SAKIP Kota Padang Tahun 2023',
            ],
            [
                'type' => 'IKM',
                'year' => 2023,
                'score' => 86.00,
                'predicate' => 'Baik',
                'description' => 'Indeks Kepuasan Masyarakat Kota Padang Tahun 2023',
            ],
            [
                'type' => 'JUMLAH_OPD',
                'year' => 2024,
                'score' => 47,
                'predicate' => null,
                'description' => 'Jumlah Organisasi Perangkat Daerah Kota Padang',
            ],
        ];

        foreach ($metrics as $metric) {
            PerformanceMetric::updateOrCreate(
                ['type' => $metric['type'], 'year' => $metric['year']],
                $metric
            );
        }
    }
}
