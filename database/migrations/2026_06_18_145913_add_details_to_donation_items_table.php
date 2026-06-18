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
        Schema::table('donation_items', function (Blueprint $table) {
            $table->foreignId('service_id')
                ->nullable()
                ->after('donation_id')
                ->constrained('services')
                ->nullOnDelete();
            $table->string('jasa_nama_manual', 150)->nullable()->after('service_id');
            $table->unsignedInteger('jasa_harga')->nullable()->after('ukuran');
            $table->unsignedInteger('jasa_estimasi_waktu')->nullable()->after('jasa_harga'); // dalam satuan hari
            $table->unsignedInteger('berat')->nullable()->after('jasa_estimasi_waktu'); // dalam satuan gram
            $table->unsignedTinyInteger('score_kelayakan')->nullable()->after('berat'); // 0-100%
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donation_items', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn([
                'service_id',
                'jasa_nama_manual',
                'jasa_harga',
                'jasa_estimasi_waktu',
                'berat',
                'score_kelayakan'
            ]);
        });
    }
};
