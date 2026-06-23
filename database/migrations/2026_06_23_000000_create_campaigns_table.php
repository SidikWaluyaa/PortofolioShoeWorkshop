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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('position')->default('catalog_top');
            $table->enum('type', ['image_upload', 'image_url', 'text_only']);
            $table->string('image_path')->nullable();
            $table->string('image_url')->nullable();
            $table->text('promo_text')->nullable();
            $table->string('cta_text')->default('Info Selengkapnya');
            $table->string('target_url')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->unsignedInteger('views_count')->default(0);
            $table->unsignedInteger('clicks_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('campaigns');
    }
};
