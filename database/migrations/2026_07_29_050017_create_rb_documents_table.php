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
        Schema::create('rb_documents', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['indeks_rb', 'sakip']);
            $table->string('title');
            $table->year('year');
            $table->text('description')->nullable();
            $table->string('document_path')->nullable();
            $table->decimal('score', 5, 2)->nullable();
            $table->string('predicate')->nullable();
            $table->timestamps();

            $table->index(['type', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rb_documents');
    }
};
