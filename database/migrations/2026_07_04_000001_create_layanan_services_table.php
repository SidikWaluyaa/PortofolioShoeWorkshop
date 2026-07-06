<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layanan_category_id')->constrained('layanan_categories')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('subtitle_teknis')->nullable();
            $table->text('kapan')->nullable();
            $table->text('proses')->nullable();
            $table->text('kenapa_penting')->nullable();
            $table->string('image_before')->nullable();
            $table->string('image_after')->nullable();
            $table->boolean('is_preview')->default(false);
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan_services');
    }
};
