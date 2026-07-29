<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Apa tugas dan fungsi Bagian Organisasi?',
                'answer' => 'Bagian Organisasi mempunyai tugas melaksanakan penyiapan perumusan kebijakan daerah, pengoordinasian perumusan kebijakan daerah, pengoordinasian pelaksanaan tugas Perangkat Daerah, pemantauan dan evaluasi pelaksanaan kebijakan daerah di bidang kelembagaan, pelayanan publik, tata laksana, dan kinerja dan reformasi birokrasi.',
                'order_index' => 1,
            ],
            [
                'question' => 'Bagaimana cara mengajukan permohonan analisis jabatan?',
                'answer' => 'Permohonan analisis jabatan dapat diajukan melalui surat resmi yang ditujukan kepada Kepala Bagian Organisasi Setda Kota Padang. Formulir permohonan dapat diunduh di halaman Download atau menghubungi kami melalui email bag.organisasi@padang.go.id.',
                'order_index' => 2,
            ],
            [
                'question' => 'Dimana saya bisa mendapatkan dokumen SOP pelayanan?',
                'answer' => 'Dokumen SOP pelayanan dapat diunduh melalui menu Tata Laksana > SOP Pelayanan atau melalui menu Download > SOP di website ini.',
                'order_index' => 3,
            ],
            [
                'question' => 'Bagaimana cara menyampaikan pengaduan pelayanan publik?',
                'answer' => 'Pengaduan pelayanan publik dapat disampaikan melalui: 1) Menu Kontak > Kritik dan Saran di website ini, 2) SP4N-LAPOR! di https://www.lapor.go.id/, atau 3) Langsung ke kantor Bagian Organisasi Setda Kota Padang.',
                'order_index' => 4,
            ],
            [
                'question' => 'Apa itu Survei Kepuasan Masyarakat (SKM)?',
                'answer' => 'Survei Kepuasan Masyarakat (SKM) adalah pengukuran secara komprehensif tentang tingkat kepuasan masyarakat terhadap kualitas layanan yang diberikan oleh penyelenggara pelayanan publik. Hasil SKM dapat dilihat di menu Pelayanan Publik > Survei Kepuasan Masyarakat.',
                'order_index' => 5,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::updateOrCreate(
                ['question' => $faq['question']],
                $faq
            );
        }
    }
}
