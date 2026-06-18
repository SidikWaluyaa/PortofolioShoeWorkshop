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
        // 1. Drop the single service columns from donation_items table
        Schema::table('donation_items', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn([
                'service_id',
                'jasa_nama_manual',
                'jasa_harga',
                'jasa_estimasi_waktu'
            ]);
        });

        // 2. Create the new pivot table for multiple services
        Schema::create('donation_item_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_item_id')
                ->constrained('donation_items')
                ->cascadeOnDelete();
            $table->foreignId('service_id')
                ->nullable()
                ->constrained('services')
                ->nullOnDelete();
            $table->string('jasa_nama_manual', 150)->nullable();
            $table->unsignedInteger('jasa_harga')->nullable();
            $table->unsignedInteger('jasa_estimasi_waktu')->nullable(); // dalam satuan hari
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Drop the pivot table
        Schema::dropIfExists('donation_item_services');

        // 2. Add the columns back to donation_items table
        Schema::table('donation_items', function (Blueprint $table) {
            $table->foreignId('service_id')
                ->nullable()
                ->after('donation_id')
                ->constrained('services')
                ->nullOnDelete();
            $table->string('jasa_nama_manual', 150)->nullable()->after('service_id');
            $table->unsignedInteger('jasa_harga')->nullable()->after('ukuran');
            $table->unsignedInteger('jasa_estimasi_waktu')->nullable()->after('jasa_harga');
        });
    }
};
