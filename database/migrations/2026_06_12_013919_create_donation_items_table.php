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
        Schema::create('donation_items', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 150);
            $table->string('brand', 100)->nullable();
            $table->enum('kategori', ['sepatu', 'tas', 'topi']);
            $table->enum('status', ['tersedia', 'disalurkan'])->default('tersedia')->index();
            $table->text('deskripsi')->nullable();
            $table->string('foto_utama_path', 255);
            $table->longText('foto_detail')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_items');
    }
};
