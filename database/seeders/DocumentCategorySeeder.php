<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DocumentCategory;

class DocumentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Peta Jabatan',
                'slug' => 'peta-jabatan',
                'group' => 'kelembagaan',
                'order_index' => 4,
            ],
            [
                'name' => 'Produk Hukum',
                'slug' => 'produk-hukum',
                'group' => 'kelembagaan',
                'order_index' => 5,
            ]
        ];

        foreach ($categories as $cat) {
            DocumentCategory::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}
