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
        Schema::create('performance_metrics', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['NILAI_RB', 'NILAI_SAKIP', 'IKM', 'JUMLAH_OPD']);
            $table->year('year');
            $table->decimal('score', 8, 2);
            $table->string('predicate')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->unique(['type', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('performance_metrics');
    }
};
