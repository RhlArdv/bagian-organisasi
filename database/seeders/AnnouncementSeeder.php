<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Seeder;

/**
 * Seeds realistic dummy pengumuman (announcements) data for development.
 *
 * Creates varied announcements: some with attachments, some pinned,
 * some with expiry dates to test all icon/badge variations in the landing page.
 */
class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $announcements = [
            [
                'title'        => 'Hasil Seleksi Administrasi Penerimaan Tenaga Non-ASN Bagian Organisasi Tahun 2026',
                'content'      => 'Berdasarkan hasil seleksi administrasi yang telah dilaksanakan, berikut disampaikan daftar peserta yang dinyatakan lolos seleksi administrasi. Peserta yang lolos diwajibkan untuk mengikuti tahap selanjutnya sesuai jadwal yang telah ditentukan.',
                'is_pinned'    => true,
                'is_active'    => true,
                'published_at' => now()->subDays(2),
                'expired_at'   => now()->addDays(30),
                // Simulates having attachment (no actual file, just field set)
                'attachment'   => null, // No real file in seeder
            ],
            [
                'title'        => 'Jadwal Pelaksanaan Survei Kepuasan Masyarakat (SKM) Periode Semester I Tahun 2026',
                'content'      => 'Pemerintah Kota Padang melalui Bagian Organisasi akan melaksanakan Survei Kepuasan Masyarakat (SKM) Semester I Tahun 2026. Survei ini bertujuan untuk mengukur tingkat kepuasan masyarakat terhadap pelayanan publik yang diberikan oleh seluruh perangkat daerah.',
                'is_pinned'    => false,
                'is_active'    => true,
                'published_at' => now()->subDays(7),
                'expired_at'   => now()->addDays(60),
                'attachment'   => null,
            ],
            [
                'title'        => 'Pemberitahuan Penyesuaian Jam Layanan Publik Selama Bulan Suci Ramadhan',
                'content'      => 'Sehubungan dengan datangnya Bulan Suci Ramadhan, dengan ini disampaikan bahwa jam pelayanan publik di lingkungan Pemerintah Kota Padang disesuaikan menjadi pukul 08.00 - 15.00 WIB.',
                'is_pinned'    => false,
                'is_active'    => true,
                'published_at' => now()->subDays(14),
                'expired_at'   => now()->addDays(15),
                'attachment'   => null,
            ],
            [
                'title'        => 'Undangan Rapat Koordinasi Evaluasi Kinerja Triwulan II Tahun 2026',
                'content'      => 'Mengundang seluruh Kepala OPD untuk hadir pada Rapat Koordinasi Evaluasi Kinerja Triwulan II yang akan dilaksanakan pada tanggal yang telah ditentukan di Ruang Rapat Utama Kantor Walikota.',
                'is_pinned'    => false,
                'is_active'    => true,
                'published_at' => now()->subDays(20),
                'expired_at'   => null,
                'attachment'   => null,
            ],
            [
                'title'        => 'Pendaftaran Workshop Analisis Jabatan dan Beban Kerja Tahun 2026 Telah Dibuka',
                'content'      => 'Bagian Organisasi membuka pendaftaran Workshop Analisis Jabatan (Anjab) dan Analisis Beban Kerja (ABK) untuk seluruh OPD. Pendaftaran dapat dilakukan melalui link yang tersedia hingga batas waktu yang ditentukan.',
                'is_pinned'    => false,
                'is_active'    => true,
                'published_at' => now()->subDays(25),
                'expired_at'   => now()->addDays(5),
                'attachment'   => null,
            ],
        ];

        foreach ($announcements as $data) {
            Announcement::updateOrCreate(
                ['title' => $data['title']],
                $data
            );
        }

        $this->command->info('✅ ' . count($announcements) . ' dummy announcements seeded.');
    }
}
