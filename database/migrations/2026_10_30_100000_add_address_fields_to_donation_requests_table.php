<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Structured shipping address for adoption requests. `alamat_pengiriman` stays as the full
 * one-line address (composed from these fields) for the admin panel, emails and older requests.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donation_requests', function (Blueprint $table) {
            $table->string('alamat_jalan')->nullable()->after('alamat_pengiriman');
            $table->string('alamat_rt_rw', 20)->nullable()->after('alamat_jalan');
            $table->string('alamat_patokan')->nullable()->after('alamat_rt_rw');
            $table->string('kelurahan', 100)->nullable()->after('alamat_patokan');
            $table->string('kecamatan', 100)->nullable()->after('kelurahan');
            $table->string('kota', 100)->nullable()->after('kecamatan');
            $table->string('provinsi', 100)->nullable()->after('kota');
            $table->string('kode_pos', 5)->nullable()->after('provinsi');
        });
    }

    public function down(): void
    {
        Schema::table('donation_requests', function (Blueprint $table) {
            $table->dropColumn(['alamat_jalan', 'alamat_rt_rw', 'alamat_patokan', 'kelurahan', 'kecamatan', 'kota', 'provinsi', 'kode_pos']);
        });
    }
};
