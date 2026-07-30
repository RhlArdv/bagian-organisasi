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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "Perangkat Daerah"
            $table->string('value'); // e.g. "47", "1.482", "81,25"
            $table->string('icon'); // e.g. "ph-buildings"
            $table->string('color'); // e.g. "brand", "blue", "green" (tailwind color name)
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
