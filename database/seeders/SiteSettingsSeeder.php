<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            // General
            ['key_name' => 'site_name', 'group' => 'general', 'value' => 'Bagian Organisasi Sekretariat Daerah Kota Padang', 'description' => 'Nama website'],
            ['key_name' => 'site_description', 'group' => 'general', 'value' => 'Portal resmi Bagian Organisasi Sekretariat Daerah Kota Padang. Website ini merupakan sarana informasi dan publikasi terkait tugas, fungsi, program kerja, serta layanan yang kami berikan kepada seluruh perangkat daerah dan masyarakat.', 'description' => 'Deskripsi website'],
            ['key_name' => 'site_logo', 'group' => 'general', 'value' => null, 'description' => 'Logo website (path file)'],
            ['key_name' => 'kepala_bagian_name', 'group' => 'general', 'value' => 'Kepala Bagian Organisasi', 'description' => 'Nama Kepala Bagian'],
            ['key_name' => 'kepala_bagian_photo', 'group' => 'general', 'value' => null, 'description' => 'Foto Kepala Bagian (path file)'],
            ['key_name' => 'kepala_bagian_sambutan', 'group' => 'general', 'value' => 'Selamat datang di website resmi Bagian Organisasi Sekretariat Daerah Kota Padang. Website ini merupakan sarana informasi dan publikasi terkait tugas, fungsi, program kerja, serta layanan yang kami berikan kepada seluruh perangkat daerah dan masyarakat. Semoga informasi yang kami sajikan dapat memberikan manfaat dan kemudahan bagi semua pihak.', 'description' => 'Sambutan Kepala Bagian'],

            // Contact
            ['key_name' => 'address', 'group' => 'contact', 'value' => 'Jl. Jenderal Sudirman No. 1, Padang, Sumatera Barat', 'description' => 'Alamat kantor'],
            ['key_name' => 'phone', 'group' => 'contact', 'value' => '(0751) 123456', 'description' => 'Nomor telepon'],
            ['key_name' => 'email', 'group' => 'contact', 'value' => 'bag.organisasi@padang.go.id', 'description' => 'Email'],
            ['key_name' => 'working_hours', 'group' => 'contact', 'value' => 'Senin - Jumat, 08.00 - 16.00 WIB', 'description' => 'Jam kerja'],
            ['key_name' => 'google_maps_embed', 'group' => 'contact', 'value' => null, 'description' => 'Google Maps embed URL'],
            ['key_name' => 'sp4n_lapor_link', 'group' => 'contact', 'value' => 'https://www.lapor.go.id/', 'description' => 'Link SP4N-LAPOR!'],

            // Social Media
            ['key_name' => 'facebook', 'group' => 'social_media', 'value' => 'https://facebook.com/', 'description' => 'Link Facebook'],
            ['key_name' => 'instagram', 'group' => 'social_media', 'value' => 'https://instagram.com/', 'description' => 'Link Instagram'],
            ['key_name' => 'youtube', 'group' => 'social_media', 'value' => 'https://youtube.com/', 'description' => 'Link YouTube'],
            ['key_name' => 'twitter', 'group' => 'social_media', 'value' => null, 'description' => 'Link Twitter/X'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key_name' => $setting['key_name']],
                $setting
            );
        }
    }
}
