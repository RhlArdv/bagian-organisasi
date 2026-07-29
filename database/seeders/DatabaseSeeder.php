<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat user admin default
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@organisasi.padang.go.id',
            'role' => 'admin',
        ]);

        // Jalankan semua seeder
        $this->call([
            SiteSettingsSeeder::class,
            BannersSeeder::class,
            PerformanceMetricsSeeder::class,
            PostCategoriesSeeder::class,
            DocumentCategoriesSeeder::class,
            FaqsSeeder::class,
        ]);
    }
}
