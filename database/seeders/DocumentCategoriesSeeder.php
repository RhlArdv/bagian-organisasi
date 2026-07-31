<?php

namespace Database\Seeders;

use App\Models\DocumentCategory;
use Illuminate\Database\Seeder;

class DocumentCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            // Kelembagaan
            ['name' => 'Penataan Kelembagaan', 'slug' => 'penataan-kelembagaan', 'group' => 'kelembagaan', 'order_index' => 1],
            ['name' => 'Evaluasi Kelembagaan', 'slug' => 'evaluasi-kelembagaan', 'group' => 'kelembagaan', 'order_index' => 2],
            ['name' => 'Nomenklatur OPD', 'slug' => 'nomenklatur-opd', 'group' => 'kelembagaan', 'order_index' => 3],
            ['name' => 'Peta Jabatan', 'slug' => 'peta-jabatan', 'group' => 'kelembagaan', 'order_index' => 4],
            ['name' => 'Produk Hukum', 'slug' => 'produk-hukum', 'group' => 'kelembagaan', 'order_index' => 5],

            // Anjab & ABK
            ['name' => 'Informasi Anjab', 'slug' => 'informasi-anjab', 'group' => 'anjab_abk', 'order_index' => 1],
            ['name' => 'Informasi ABK', 'slug' => 'informasi-abk', 'group' => 'anjab_abk', 'order_index' => 2],
            ['name' => 'Pedoman Anjab & ABK', 'slug' => 'pedoman-anjab-abk', 'group' => 'anjab_abk', 'order_index' => 3],
            ['name' => 'Formulir Permohonan', 'slug' => 'formulir-permohonan', 'group' => 'anjab_abk', 'order_index' => 4],

            // Pelayanan Publik
            ['name' => 'Standar Pelayanan', 'slug' => 'standar-pelayanan', 'group' => 'pelayanan', 'order_index' => 1],
            ['name' => 'Maklumat Pelayanan', 'slug' => 'maklumat-pelayanan', 'group' => 'pelayanan', 'order_index' => 2],
            ['name' => 'Dokumen Pelayanan Publik', 'slug' => 'dokumen-pelayanan-publik', 'group' => 'pelayanan', 'order_index' => 3],
            ['name' => 'SKM', 'slug' => 'skm', 'group' => 'pelayanan', 'order_index' => 4],
            ['name' => 'Pengelolaan Pengaduan', 'slug' => 'pengelolaan-pengaduan', 'group' => 'pelayanan', 'order_index' => 5],

            // Tata Laksana
            ['name' => 'SOP Pelayanan', 'slug' => 'sop-pelayanan', 'group' => 'tatalaksana', 'order_index' => 1],
            ['name' => 'Peta Proses Bisnis', 'slug' => 'peta-proses-bisnis', 'group' => 'tatalaksana', 'order_index' => 2],
            ['name' => 'Tata Naskah Dinas', 'slug' => 'tata-naskah-dinas', 'group' => 'tatalaksana', 'order_index' => 3],

            // Reformasi Birokrasi
            ['name' => 'Indeks RB', 'slug' => 'indeks-rb', 'group' => 'reformasi_birokrasi', 'order_index' => 1],
            ['name' => 'SAKIP', 'slug' => 'sakip', 'group' => 'reformasi_birokrasi', 'order_index' => 2],

            // Regulasi
            ['name' => 'Undang-Undang', 'slug' => 'undang-undang', 'group' => 'regulasi', 'order_index' => 1],
            ['name' => 'Peraturan Pemerintah', 'slug' => 'peraturan-pemerintah', 'group' => 'regulasi', 'order_index' => 2],
            ['name' => 'PermenPANRB', 'slug' => 'permenpanrb', 'group' => 'regulasi', 'order_index' => 3],
            ['name' => 'Perda', 'slug' => 'perda', 'group' => 'regulasi', 'order_index' => 4],
            ['name' => 'Perwako', 'slug' => 'perwako', 'group' => 'regulasi', 'order_index' => 5],
            ['name' => 'Surat Edaran', 'slug' => 'surat-edaran', 'group' => 'regulasi', 'order_index' => 6],

            // Download
            ['name' => 'Formulir', 'slug' => 'formulir-download', 'group' => 'download', 'order_index' => 1],
            ['name' => 'SOP', 'slug' => 'sop-download', 'group' => 'download', 'order_index' => 2],
            ['name' => 'Standar Pelayanan', 'slug' => 'standar-pelayanan-download', 'group' => 'download', 'order_index' => 3],
            ['name' => 'Pedoman', 'slug' => 'pedoman-download', 'group' => 'download', 'order_index' => 4],
            ['name' => 'Template', 'slug' => 'template-download', 'group' => 'download', 'order_index' => 5],
        ];

        foreach ($categories as $category) {
            DocumentCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
