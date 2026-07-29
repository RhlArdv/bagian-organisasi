<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            [
                'title' => 'Bagian Organisasi',
                'subtitle' => 'Sekretariat Daerah Kota Padang — Mewujudkan tata kelola organisasi yang efektif, efisien, transparan dan berorientasi pada pelayanan publik untuk Kota Padang yang lebih baik.',
                'image' => 'banners/banner-1.jpg',
                'button_text' => 'Selengkapnya',
                'button_link' => '/profil/visi-misi',
                'is_active' => true,
                'order_index' => 1,
            ],
            [
                'title' => 'Reformasi Birokrasi',
                'subtitle' => 'Mendorong percepatan reformasi birokrasi untuk mewujudkan pemerintahan yang bersih, akuntabel, dan profesional.',
                'image' => 'banners/banner-2.jpg',
                'button_text' => 'Pelajari Lebih Lanjut',
                'button_link' => '/reformasi-birokrasi',
                'is_active' => true,
                'order_index' => 2,
            ],
            [
                'title' => 'Pelayanan Publik Prima',
                'subtitle' => 'Meningkatkan kualitas pelayanan publik melalui standarisasi, evaluasi, dan inovasi pelayanan.',
                'image' => 'banners/banner-3.jpg',
                'button_text' => 'Lihat Layanan',
                'button_link' => '/pelayanan-publik',
                'is_active' => true,
                'order_index' => 3,
            ],
        ];

        foreach ($banners as $banner) {
            Banner::updateOrCreate(
                ['title' => $banner['title']],
                $banner
            );
        }
    }
}
