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
            ],
            [
                'name' => 'Informasi Anjab',
                'slug' => 'informasi-anjab',
                'group' => 'kinerja',
                'order_index' => 1,
            ],
            [
                'name' => 'Informasi ABK',
                'slug' => 'informasi-abk',
                'group' => 'kinerja',
                'order_index' => 2,
            ],
            [
                'name' => 'Pedoman',
                'slug' => 'pedoman',
                'group' => 'umum',
                'order_index' => 1,
            ],
            [
                'name' => 'Formulir Permohonan',
                'slug' => 'formulir-permohonan',
                'group' => 'umum',
                'order_index' => 2,
            ],
            // Pelayanan Publik (dokumen-based)
            [
                'name' => 'Maklumat Pelayanan',
                'slug' => 'maklumat-pelayanan',
                'group' => 'pelayanan-publik',
                'order_index' => 2,
            ],
            [
                'name' => 'Survei Kepuasan Masyarakat',
                'slug' => 'skm',
                'group' => 'pelayanan-publik',
                'order_index' => 3,
            ],
            [
                'name' => 'Pengelolaan Pengaduan',
                'slug' => 'pengelolaan-pengaduan',
                'group' => 'pelayanan-publik',
                'order_index' => 5,
            ],
            [
                'name' => 'Dokumen Pelayanan Publik',
                'slug' => 'dokumen-pelayanan-publik',
                'group' => 'pelayanan-publik',
                'order_index' => 6,
            ],
            // Tata Laksana
            [
                'name' => 'SOP Pelayanan',
                'slug' => 'sop-pelayanan',
                'group' => 'tata-laksana',
                'order_index' => 1,
            ],
            [
                'name' => 'Peta Proses Bisnis',
                'slug' => 'peta-proses-bisnis',
                'group' => 'tata-laksana',
                'order_index' => 2,
            ],
            [
                'name' => 'Tata Naskah Dinas',
                'slug' => 'tata-naskah-dinas',
                'group' => 'tata-laksana',
                'order_index' => 3,
            ],
            // Reformasi Birokrasi
            [
                'name' => 'Indeks Reformasi Birokrasi',
                'slug' => 'indeks-rb',
                'group' => 'reformasi-birokrasi',
                'order_index' => 1,
            ],
            [
                'name' => 'SAKIP',
                'slug' => 'sakip',
                'group' => 'reformasi-birokrasi',
                'order_index' => 2,
            ],
        ];

        foreach ($categories as $cat) {
            DocumentCategory::updateOrCreate(
                ['slug' => $cat['slug']],
                $cat
            );
        }
    }
}
