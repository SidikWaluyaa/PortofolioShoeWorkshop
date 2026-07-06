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
        try {
            Schema::table('donation_items', function (Blueprint $table) {
                $table->string('warna')->nullable()->after('ukuran');
            });
        } catch (\Exception $e) {
            // ignore if column already exists
        }

        try {
            Schema::table('donation_item_services', function (Blueprint $table) {
                $table->boolean('is_mandatory')->default(true)->after('jasa_estimasi_waktu');
            });
        } catch (\Exception $e) {
            // ignore if column already exists
        }

        try {
            Schema::table('donation_requests', function (Blueprint $table) {
                $table->text('selected_services')->nullable()->after('alasan');
            });
        } catch (\Exception $e) {
            // ignore if column already exists
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donation_items', function (Blueprint $table) {
            $table->dropColumn('warna');
        });

        Schema::table('donation_item_services', function (Blueprint $table) {
            $table->dropColumn('is_mandatory');
        });

        Schema::table('donation_requests', function (Blueprint $table) {
            $table->dropColumn('selected_services');
        });
    }
};
