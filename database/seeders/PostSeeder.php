<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Seeds realistic dummy berita (posts) data for development.
 *
 * Assigns random categories and uses the first user as author.
 */
class PostSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure categories exist first
        $this->call(PostCategoriesSeeder::class);

        $categories = PostCategory::all();
        $author = User::first();

        if (!$author) {
            $this->command->warn('No user found — skipping PostSeeder. Please create a user first.');
            return;
        }

        $posts = [
            [
                'title'   => 'Rapat Koordinasi Sekretariat Daerah Bahas Penguatan Kinerja dan Evaluasi',
                'excerpt' => 'Pemerintah Kota Padang terus mendorong transformasi pelayanan publik melalui digitalisasi proses bisnis dan penguatan SDM aparatur secara berkesinambungan.',
                'content' => '<p>Bertempat di Ruang Rapat Utama Kantor Walikota Padang, Sekretaris Daerah Kota Padang memimpin Rapat Koordinasi yang dihadiri oleh seluruh Kepala Bagian di lingkungan Sekretariat Daerah.</p>
<h2>Agenda Rapat</h2>
<p>Rapat ini membahas beberapa agenda strategis terkait penguatan kinerja organisasi perangkat daerah, antara lain:</p>
<ul>
<li>Evaluasi capaian kinerja triwulan II tahun 2026</li>
<li>Penyusunan rencana aksi semester II</li>
<li>Penguatan koordinasi antar bagian</li>
<li>Implementasi e-government dalam pelayanan internal</li>
</ul>
<h2>Hasil Kesepakatan</h2>
<p>Dari rapat tersebut disepakati beberapa poin penting:</p>
<ol>
<li>Setiap bagian wajib menyusun laporan capaian kinerja bulanan secara digital</li>
<li>Penerapan standar pelayanan minimal (SPM) dipercepat</li>
<li>Koordinasi lintas sektor ditingkatkan melalui forum bulanan</li>
</ol>
<blockquote>Transformasi birokrasi bukan sekadar digitalisasi, tetapi perubahan mindset dan budaya kerja aparatur — Sekretaris Daerah Kota Padang</blockquote>
<p>Rapat berlangsung selama kurang lebih 3 jam dan diakhiri dengan penandatanganan kesepakatan bersama seluruh Kepala Bagian.</p>',
                'category_slug' => 'pemerintahan',
                'days_ago'      => 1,
            ],
            [
                'title'   => 'Pemkot Padang Raih Penghargaan SAKIP Predikat A Tingkat Nasional',
                'excerpt' => 'Pencapaian ini menunjukkan komitmen Pemerintah Kota Padang dalam mewujudkan akuntabilitas kinerja yang semakin baik dari tahun ke tahun.',
                'content' => '<p>Pemerintah Kota Padang kembali menorehkan prestasi gemilang di tingkat nasional dengan meraih Penghargaan Sistem Akuntabilitas Kinerja Instansi Pemerintah (SAKIP) dengan predikat "A".</p>
<h2>Sejarah Penilaian SAKIP Kota Padang</h2>
<p>Predikat A ini merupakan peningkatan signifikan dari tahun-tahun sebelumnya. Berikut perkembangan penilaian SAKIP Kota Padang:</p>
<ul>
<li><strong>2022:</strong> Predikat BB (Nilai 72,50)</li>
<li><strong>2023:</strong> Predikat BB (Nilai 75,80)</li>
<li><strong>2024:</strong> Predikat A (Nilai 80,15)</li>
<li><strong>2025:</strong> Predikat A (Nilai 82,30)</li>
<li><strong>2026:</strong> Predikat A (Nilai 85,10)</li>
</ul>
<h2>Faktor Keberhasilan</h2>
<p>Beberapa faktor kunci yang mendukung pencapaian ini antara lain:</p>
<ol>
<li>Penguatan perencanaan kinerja berbasis outcome</li>
<li>Implementasi dashboard monitoring kinerja real-time</li>
<li>Capacity building bagi seluruh evaluator internal</li>
<li>Integrasi sistem perencanaan, penganggaran, dan pelaporan</li>
</ol>
<p>Penghargaan ini diserahkan langsung oleh Menteri Pendayagunaan Aparatur Negara dan Reformasi Birokrasi dalam acara puncak Hari Reformasi Birokrasi Nasional di Jakarta.</p>',
                'category_slug' => 'reformasi-birokrasi',
                'days_ago'      => 3,
            ],
            [
                'title'   => 'Inovasi Layanan Publik Berbasis Digital Resmi Diluncurkan',
                'excerpt' => 'Bagian Organisasi meluncurkan platform layanan publik digital terintegrasi untuk mempercepat dan mempermudah akses masyarakat terhadap layanan pemerintah.',
                'content' => '<p>Dalam rangka mendukung transformasi digital pelayanan publik, Bagian Organisasi Sekretariat Daerah Kota Padang secara resmi meluncurkan Platform Layanan Publik Digital Terintegrasi.</p>
<h2>Fitur Utama Platform</h2>
<p>Platform ini menyediakan berbagai fitur unggulan:</p>
<ul>
<li><strong>Tracking Permohonan:</strong> Masyarakat dapat melacak status permohonan secara real-time</li>
<li><strong>Pengaduan Online:</strong> Sistem pengaduan terintegrasi dengan response time terukur</li>
<li><strong>Informasi Standar Pelayanan:</strong> Akses lengkap ke SOP dan standar pelayanan</li>
<li><strong>Survey Kepuasan:</strong> Feedback langsung dari pengguna layanan</li>
</ul>
<h2>Target dan Harapan</h2>
<p>Platform ini ditargetkan dapat melayani minimal 10.000 pengguna per bulan dan mengurangi waktu proses layanan hingga 50% dari metode konvensional.</p>
<blockquote>Inovasi ini merupakan wujud komitmen kami untuk memberikan pelayanan yang cepat, transparan, dan akuntabel kepada masyarakat Kota Padang.</blockquote>',
                'category_slug' => 'layanan-publik',
                'days_ago'      => 5,
            ],
            [
                'title'   => 'Sosialisasi Pemetaan Nomenklatur Perangkat Daerah 2026',
                'excerpt' => 'Kegiatan sosialisasi ini bertujuan untuk menyelaraskan nomenklatur perangkat daerah sesuai regulasi terbaru dari pemerintah pusat.',
                'content' => '<p>Bagian Organisasi Sekretariat Daerah Kota Padang menyelenggarakan Sosialisasi Pemetaan Nomenklatur Perangkat Daerah Tahun 2026 yang dihadiri oleh seluruh Organisasi Perangkat Daerah (OPD) di lingkungan Pemerintah Kota Padang.</p>
<h2>Latar Belakang</h2>
<p>Pemetaan nomenklatur ini dilakukan sebagai tindak lanjut dari Peraturan Pemerintah Nomor 18 Tahun 2016 tentang Perangkat Daerah beserta perubahannya. Regulasi ini mengamanatkan penyesuaian struktur organisasi agar lebih efektif dan efisien.</p>
<h2>Materi Sosialisasi</h2>
<ul>
<li>Review regulasi terbaru terkait kelembagaan perangkat daerah</li>
<li>Metodologi pemetaan urusan dan tipologi</li>
<li>Best practices dari daerah lain</li>
<li>Timeline penyesuaian nomenklatur</li>
</ul>
<p>Kegiatan berlangsung selama satu hari penuh dan diharapkan dapat memberikan pemahaman yang komprehensif kepada seluruh OPD mengenai arah kebijakan penataan kelembagaan.</p>',
                'category_slug' => 'kelembagaan',
                'days_ago'      => 7,
            ],
            [
                'title'   => 'Workshop Penyusunan SOP Berbasis Proses Bisnis untuk Seluruh OPD',
                'excerpt' => 'Workshop ini melatih aparatur dalam menyusun Standar Operasional Prosedur yang terstruktur dan terstandarisasi berdasarkan analisis proses bisnis.',
                'content' => '<p>Bagian Organisasi Sekretariat Daerah Kota Padang menyelenggarakan Workshop Penyusunan SOP Berbasis Proses Bisnis yang diikuti oleh perwakilan dari seluruh Organisasi Perangkat Daerah.</p>
<h2>Tujuan Workshop</h2>
<ol>
<li>Meningkatkan pemahaman aparatur tentang penyusunan SOP berbasis proses bisnis</li>
<li>Menghasilkan draft SOP yang terstandarisasi untuk setiap layanan</li>
<li>Membangun kapasitas internal OPD dalam dokumentasi prosedur</li>
</ol>
<h2>Metodologi</h2>
<p>Workshop menggunakan pendekatan <strong>learning by doing</strong> dengan metode:</p>
<ul>
<li>Pemaparan teori dan regulasi</li>
<li>Praktik pemetaan proses bisnis</li>
<li>Simulasi penyusunan SOP</li>
<li>Review dan feedback oleh narasumber</li>
</ul>
<p>Narasumber utama berasal dari Kementerian PANRB dan akademisi dari Universitas Andalas yang memiliki keahlian di bidang manajemen proses bisnis sektor publik.</p>',
                'category_slug' => 'kegiatan',
                'days_ago'      => 10,
            ],
            [
                'title'   => 'Pelaksanaan Survei Kepuasan Masyarakat Semester I Tahun 2026',
                'excerpt' => 'Survei ini dilakukan untuk mengukur tingkat kepuasan masyarakat terhadap pelayanan publik yang diberikan oleh perangkat daerah Kota Padang.',
                'content' => '<p>Dalam rangka meningkatkan kualitas pelayanan publik, Pemerintah Kota Padang melalui Bagian Organisasi melaksanakan Survei Kepuasan Masyarakat (SKM) Semester I Tahun 2026.</p>
<h2>Cakupan Survei</h2>
<p>Survei mencakup 9 unsur pelayanan sesuai Permenpan RB Nomor 14 Tahun 2017:</p>
<ul>
<li>Persyaratan pelayanan</li>
<li>Sistem, mekanisme, dan prosedur</li>
<li>Waktu penyelesaian</li>
<li>Biaya/tarif</li>
<li>Produk spesifikasi jenis pelayanan</li>
<li>Kompetensi pelaksana</li>
<li>Perilaku pelaksana</li>
<li>Penanganan pengaduan, saran, dan masukan</li>
<li>Sarana dan prasarana</li>
</ul>
<h2>Metodologi dan Target Responden</h2>
<p>Survei dilakukan dengan metode campuran (online dan offline) dengan target 500 responden dari berbagai unit layanan. Hasil SKM akan dipublikasikan secara terbuka sebagai bentuk transparansi dan akuntabilitas.</p>',
                'category_slug' => 'layanan-publik',
                'days_ago'      => 14,
            ],
            [
                'title'   => 'Penandatanganan MoU Pengembangan Kapasitas ASN dengan Universitas Andalas',
                'excerpt' => 'Kerjasama strategis ini bertujuan untuk meningkatkan kompetensi aparatur sipil negara melalui program pelatihan dan penelitian bersama.',
                'content' => '<p>Pemerintah Kota Padang menjalin kerjasama strategis dengan Universitas Andalas melalui penandatanganan Memorandum of Understanding (MoU) tentang Pengembangan Kapasitas Aparatur Sipil Negara.</p>
<h2>Ruang Lingkup Kerjasama</h2>
<ul>
<li>Program pelatihan dan sertifikasi kompetensi ASN</li>
<li>Penelitian bersama tentang tata kelola pemerintahan</li>
<li>Magang dan pertukaran SDM</li>
<li>Pengembangan kurikulum pelatihan berbasis kebutuhan daerah</li>
</ul>
<h2>Dampak yang Diharapkan</h2>
<p>MoU ini diharapkan dapat meningkatkan kapasitas ASN dalam:</p>
<ol>
<li>Penguasaan teknologi informasi dan digitalisasi</li>
<li>Kemampuan analisis kebijakan publik</li>
<li>Keterampilan manajemen proyek</li>
<li>Leadership dan soft skills</li>
</ol>
<p>Kerjasama ini berlaku selama 3 tahun dan dapat diperpanjang sesuai kebutuhan kedua belah pihak.</p>',
                'category_slug' => 'kegiatan',
                'days_ago'      => 18,
            ],
            [
                'title'   => 'Evaluasi Kelembagaan Perangkat Daerah Kota Padang Tahun 2026',
                'excerpt' => 'Evaluasi dilakukan untuk menilai efektivitas dan efisiensi struktur organisasi perangkat daerah dalam melaksanakan tugas dan fungsinya.',
                'content' => '<p>Bagian Organisasi Sekretariat Daerah Kota Padang melaksanakan Evaluasi Kelembagaan Perangkat Daerah yang merupakan agenda rutin tahunan dalam rangka memastikan struktur organisasi yang optimal.</p>
<h2>Aspek yang Dievaluasi</h2>
<ul>
<li><strong>Efektivitas:</strong> Kesesuaian antara tugas pokok dan fungsi dengan capaian kinerja</li>
<li><strong>Efisiensi:</strong> Rasionalitas penggunaan sumber daya (anggaran, SDM, sarana prasarana)</li>
<li><strong>Kecukupan:</strong> Kelengkapan struktur untuk mendukung pelaksanaan urusan</li>
<li><strong>Keselarasan:</strong> Sinkronisasi dengan regulasi dan kebijakan nasional terkini</li>
</ul>
<h2>Temuan Awal</h2>
<p>Dari evaluasi awal ditemukan beberapa poin yang perlu ditindaklanjuti, antara lain perlunya penyesuaian nomenklatur pada beberapa OPD dan penguatan fungsi koordinasi antar unit kerja.</p>
<p>Hasil evaluasi lengkap akan disampaikan kepada Walikota Padang sebagai bahan pertimbangan kebijakan penataan kelembagaan selanjutnya.</p>',
                'category_slug' => 'kelembagaan',
                'days_ago'      => 22,
            ],
        ];

        foreach ($posts as $postData) {
            $category = $categories->firstWhere('slug', $postData['category_slug']);

            Post::updateOrCreate(
                ['title' => $postData['title']],
                [
                    'slug'         => Str::slug($postData['title']) . '-' . Str::random(5),
                    'category_id'  => $category?->id,
                    'author_id'    => $author->id,
                    'excerpt'      => $postData['excerpt'],
                    'content'      => $postData['content'],
                    'status'       => 'published',
                    'published_at' => now()->subDays($postData['days_ago']),
                    'views'        => rand(15, 350),
                ]
            );
        }

        $this->command->info('✅ ' . count($posts) . ' dummy posts seeded.');
    }
}
