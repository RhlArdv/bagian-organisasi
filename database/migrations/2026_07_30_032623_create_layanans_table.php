<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('layanans', function (Blueprint $table) {
            $table->id();
            $table->string('kategori'); // penataan-kelembagaan, evaluasi-kelembagaan, etc.
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->longText('dasar_hukum')->nullable();
            $table->string('maklumat_image')->nullable();
            $table->longText('persyaratan')->nullable();
            $table->longText('sistem_mekanisme')->nullable();
            $table->string('flowchart_image')->nullable();
            $table->string('jangka_waktu')->nullable();
            $table->string('biaya')->nullable();
            $table->string('produk_pelayanan')->nullable();
            $table->longText('pengaduan')->nullable();
            $table->text('informasi_tambahan')->nullable();
            $table->string('link_sippn')->nullable();
            $table->string('file_download')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanans');
    }
};
