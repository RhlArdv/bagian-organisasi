<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'visi-misi',
                'title' => 'Visi & Misi',
                'content' => '<p><strong>Visi</strong><br>Mewujudkan tata kelola pemerintahan yang baik, bersih, dan melayani.</p><p><strong>Misi</strong><br>1. Meningkatkan kualitas pelayanan publik.<br>2. Mengoptimalkan kinerja aparatur daerah.</p>',
            ],
            [
                'slug' => 'tugas-fungsi',
                'title' => 'Tugas & Fungsi (Tupoksi)',
                'content' => '<p>Bagian Organisasi mempunyai tugas melaksanakan penyiapan perumusan kebijakan daerah, pengoordinasian perumusan kebijakan daerah, pengoordinasian pelaksanaan tugas Perangkat Daerah, pemantauan dan evaluasi pelaksanaan kebijakan daerah di bidang kelembagaan dan analisis jabatan, ketatalaksanaan, dan pelayanan publik dan reformasi birokrasi.</p>',
            ],
            [
                'slug' => 'struktur-organisasi',
                'title' => 'Struktur Organisasi',
                'content' => '<p>Struktur Organisasi Bagian Organisasi Setda Kota Padang.</p>',
            ],
            [
                'slug' => 'maklumat-pelayanan',
                'title' => 'Maklumat Pelayanan',
                'content' => '<p>Kami menyatakan sanggup menyelenggarakan pelayanan sesuai standar pelayanan yang telah ditetapkan dan apabila tidak menepati janji ini, kami siap menerima sanksi sesuai peraturan perundang-undangan yang berlaku.</p>',
            ]
        ];

        foreach ($pages as $page) {
            Page::firstOrCreate(
                ['slug' => $page['slug']],
                ['title' => $page['title'], 'content' => $page['content']]
            );
        }
    }
}
