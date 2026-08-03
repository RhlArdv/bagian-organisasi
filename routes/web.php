<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicBeritaController;
use App\Http\Controllers\PublicLayananController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Increment unique visitor count for the homepage
    \App\Models\VisitorStat::recordVisit(true);

    $latestPosts = \App\Models\Post::published()
        ->with(['category', 'author'])
        ->limit(4)
        ->get();
    $postCategories = \App\Models\PostCategory::orderBy('name')->get();
    $announcements = \App\Models\Announcement::active()->limit(5)->get();
    $statistics = \App\Models\Statistic::orderBy('order')->get();
    $agendas = \App\Models\Agenda::orderBy('date', 'asc')->limit(3)->get();
    $faqs = \App\Models\Faq::active()->get();
    
    // Visitor Stats
    $visitorToday = \App\Models\VisitorStat::getTodayVisitors();
    $visitorMonth = \App\Models\VisitorStat::getThisMonthVisitors();
    $visitorYear = \App\Models\VisitorStat::getThisYearVisitors();
    $visitorTotal = \App\Models\VisitorStat::getTotalVisitors();
    $visitorChartData = \App\Models\VisitorStat::getChartData();

    return view('welcome', compact(
        'latestPosts', 'postCategories', 'announcements', 'statistics',
        'visitorToday', 'visitorMonth', 'visitorYear', 'visitorTotal', 'visitorChartData',
        'agendas', 'faqs'
    ));
});

Route::get('/profil', function () {
    return view('profil');
});

// Halaman Publik — Layanan Unggulan (6 cards dari landing page)
Route::get('/layanan/reformasi-birokrasi', [PublicLayananController::class, 'reformasiBirokrasi'])->name('public.reformasi-birokrasi');
Route::get('/layanan/sop', [PublicLayananController::class, 'sop'])->name('public.sop');
Route::get('/layanan/anjab-abk', [PublicLayananController::class, 'anjabAbk'])->name('public.anjab-abk');
Route::get('/layanan/pengaduan', [PublicLayananController::class, 'pengaduan'])->name('public.pengaduan');
Route::post('/layanan/pengaduan', [PublicLayananController::class, 'storePengaduan'])->middleware('throttle:5,1')->name('public.pengaduan.store');
Route::post('/layanan/kritik-saran', [PublicLayananController::class, 'storeKritikSaran'])->middleware('throttle:5,1')->name('public.kritik-saran.store');
Route::get('/layanan/kelembagaan', [PublicLayananController::class, 'kelembagaan'])->name('public.kelembagaan');
Route::get('/layanan/standar-pelayanan', [PublicLayananController::class, 'standarPelayanan'])->name('public.standar-pelayanan');

// Halaman Publik — Berita
Route::get('/berita', [PublicBeritaController::class, 'index'])->name('public.berita.index');
Route::get('/berita/{slug}', [PublicBeritaController::class, 'show'])->name('public.berita.show');


Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin Routes
    Route::resource('admin/pages', \App\Http\Controllers\Admin\PageController::class)->only(['index', 'edit', 'update']);
    Route::resource('admin/pegawai', \App\Http\Controllers\Admin\PegawaiController::class);
    Route::resource('admin/banners', \App\Http\Controllers\Admin\BannerController::class);
    Route::resource('admin/metrics', \App\Http\Controllers\Admin\PerformanceMetricController::class);
    Route::resource('admin/statistics', \App\Http\Controllers\Admin\StatisticController::class);
    Route::resource('admin/agendas', \App\Http\Controllers\Admin\AgendaController::class);
    
    // Kelembagaan (Layanan)
    Route::get('/layanan', [App\Http\Controllers\PublicLayananController::class, 'index'])->name('public.layanan.index');
    Route::get('/layanan/{id}', [App\Http\Controllers\PublicLayananController::class, 'show'])->name('public.layanan.show');
    
    // Public Agenda Routes
    Route::get('/agenda', [App\Http\Controllers\PublicAgendaController::class, 'index'])->name('public.agendas.index');
    Route::get('/agenda/{id}', [App\Http\Controllers\PublicAgendaController::class, 'show'])->name('public.agendas.show');
    
    Route::get('admin/layanan/{kategori}', [\App\Http\Controllers\Admin\LayananController::class, 'index'])->name('layanan.index');
    Route::get('admin/layanan/{kategori}/create', [\App\Http\Controllers\Admin\LayananController::class, 'create'])->name('layanan.create');
    Route::post('admin/layanan/{kategori}', [\App\Http\Controllers\Admin\LayananController::class, 'store'])->name('layanan.store');
    Route::get('admin/layanan/{kategori}/{id}/edit', [\App\Http\Controllers\Admin\LayananController::class, 'edit'])->name('layanan.edit');
    Route::put('admin/layanan/{kategori}/{id}', [\App\Http\Controllers\Admin\LayananController::class, 'update'])->name('layanan.update');
    Route::delete('admin/layanan/{kategori}/{id}', [\App\Http\Controllers\Admin\LayananController::class, 'destroy'])->name('layanan.destroy');
    
    // Kelembagaan (Documents / PDF Uploads)
    Route::get('admin/documents/{kategori_slug}', [\App\Http\Controllers\Admin\DocumentController::class, 'index'])->name('documents.index');
    Route::get('admin/documents/{kategori_slug}/create', [\App\Http\Controllers\Admin\DocumentController::class, 'create'])->name('documents.create');
    Route::post('admin/documents/{kategori_slug}', [\App\Http\Controllers\Admin\DocumentController::class, 'store'])->name('documents.store');
    Route::get('admin/documents/{kategori_slug}/{id}/edit', [\App\Http\Controllers\Admin\DocumentController::class, 'edit'])->name('documents.edit');
    Route::put('admin/documents/{kategori_slug}/{id}', [\App\Http\Controllers\Admin\DocumentController::class, 'update'])->name('documents.update');
    Route::delete('admin/documents/{kategori_slug}/{id}', [\App\Http\Controllers\Admin\DocumentController::class, 'destroy'])->name('documents.destroy');
    
    // Berita & Pengumuman
    Route::resource('admin/posts', \App\Http\Controllers\Admin\PostController::class);
    Route::resource('admin/announcements', \App\Http\Controllers\Admin\AnnouncementController::class);

    // Pengaturan
    Route::get('admin/settings/contact', [\App\Http\Controllers\Admin\SettingController::class, 'contact'])->name('settings.contact');
    Route::put('admin/settings/contact', [\App\Http\Controllers\Admin\SettingController::class, 'updateContact'])->name('settings.contact.update');
    
    // FAQ
    Route::resource('admin/faqs', \App\Http\Controllers\Admin\FaqController::class);
    
    // Kritik, Saran & Pengaduan (Feedback)
    Route::resource('admin/feedbacks', \App\Http\Controllers\Admin\FeedbackController::class)->only(['index', 'show', 'update', 'destroy']);
});

require __DIR__.'/auth.php';
