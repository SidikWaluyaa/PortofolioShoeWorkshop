<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan_categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->integer('order')->default(0);
            $table->string('name');
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->text('value_material')->nullable();
            $table->text('value_kehidupan')->nullable();
            $table->string('cta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan_categories');
    }
};
