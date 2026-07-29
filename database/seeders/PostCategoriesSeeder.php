<?php

namespace Database\Seeders;

use App\Models\PostCategory;
use Illuminate\Database\Seeder;

class PostCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Pemerintahan', 'slug' => 'pemerintahan'],
            ['name' => 'Kegiatan', 'slug' => 'kegiatan'],
            ['name' => 'Layanan Publik', 'slug' => 'layanan-publik'],
            ['name' => 'Kelembagaan', 'slug' => 'kelembagaan'],
            ['name' => 'Reformasi Birokrasi', 'slug' => 'reformasi-birokrasi'],
            ['name' => 'Pengumuman', 'slug' => 'pengumuman'],
        ];

        foreach ($categories as $category) {
            PostCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
