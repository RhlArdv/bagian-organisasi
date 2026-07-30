<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Post;
use App\Models\Document;
use App\Models\DocumentCategory;

class DashboardController extends Controller
{
    public function index()
    {
        $pegawaiCount = Pegawai::count();
        $beritaCount = Post::published()->count();
        
        $regulasiSlugs = ['undang-undang', 'peraturan-pemerintah', 'permenpanrb', 'perda', 'perwako', 'surat-edaran'];
        $regulasiCount = Document::active()->whereHas('category', function($q) use ($regulasiSlugs) {
            $q->whereIn('slug', $regulasiSlugs);
        })->count();

        $pengumumanCount = \App\Models\Announcement::count();
        $faqCount = \App\Models\Faq::count();
        $bannerCount = \App\Models\Banner::active()->count();
        $layananCount = Document::active()->whereHas('category', function($q) {
            $q->whereIn('slug', ['standar-pelayanan', 'maklumat-pelayanan', 'skm', 'forum-konsultasi-publik', 'pengelolaan-pengaduan', 'dokumen-pelayanan-publik']);
        })->count();

        return view('dashboard', compact('pegawaiCount', 'beritaCount', 'regulasiCount', 'pengumumanCount', 'faqCount', 'bannerCount', 'layananCount'));
    }
}
