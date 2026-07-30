<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profil', function () {
    return view('profil');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Admin Routes
    Route::resource('admin/pages', \App\Http\Controllers\Admin\PageController::class)->only(['index', 'edit', 'update']);
    Route::resource('admin/pegawai', \App\Http\Controllers\Admin\PegawaiController::class);
    Route::resource('admin/banners', \App\Http\Controllers\Admin\BannerController::class);
    Route::resource('admin/metrics', \App\Http\Controllers\Admin\PerformanceMetricController::class);
    
    // Kelembagaan (Layanan)
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
});

require __DIR__.'/auth.php';
