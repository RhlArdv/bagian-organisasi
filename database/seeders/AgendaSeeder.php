<?php

namespace Database\Seeders;

use App\Models\Agenda;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        $agendas = [
            [
                'title' => 'Kunjungan Kerja ke Kec. Bungus',
                'location' => 'Kec. Bungus',
                'date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'time' => '09:00 WIB',
                'image' => null, // We'll just use the default fallback in view if image is null
                'description' => 'Kunjungan kerja dalam rangka evaluasi pelayanan publik.',
            ],
            [
                'title' => 'Rapat Koordinasi Prioritas Daerah',
                'location' => 'Ruang Rapat Sekda',
                'date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'time' => '10:00 WIB',
                'image' => null,
                'description' => 'Membahas prioritas pembangunan daerah tahun 2026.',
            ],
            [
                'title' => 'Penandatanganan Komitmen Bersama',
                'location' => 'Aula Wako',
                'date' => Carbon::now()->addDays(8)->format('Y-m-d'),
                'time' => '14:00 WIB',
                'image' => null,
                'description' => 'Penandatanganan komitmen bersama seluruh OPD.',
            ],
        ];

        foreach ($agendas as $agenda) {
            Agenda::create($agenda);
        }
    }
}
