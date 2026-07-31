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
        User::updateOrCreate(
            ['email' => 'admin@organisasi.padang.go.id'],
            [
                'name' => 'Administrator',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        // Jalankan semua seeder
        $this->call([
            SiteSettingsSeeder::class,
            BannersSeeder::class,
            PerformanceMetricsSeeder::class,
            PageSeeder::class,
            PostCategoriesSeeder::class,
            DocumentCategoriesSeeder::class,
            FaqsSeeder::class,
        ]);
    }
}
