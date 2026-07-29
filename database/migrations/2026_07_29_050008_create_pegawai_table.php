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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 20)->unique();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('pangkat_golongan')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('foto')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->enum('level', ['kepala', 'kasubag', 'staf'])->default('staf');
            $table->foreignId('parent_id')->nullable()->constrained('pegawai')->nullOnDelete();
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
