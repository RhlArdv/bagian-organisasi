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
});

require __DIR__.'/auth.php';
