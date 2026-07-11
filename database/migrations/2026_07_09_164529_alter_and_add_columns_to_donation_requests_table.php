<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Alter status ENUM
        DB::statement("ALTER TABLE donation_requests MODIFY COLUMN status ENUM('pending', 'menunggu_pembayaran', 'menunggu_verifikasi', 'diproses', 'dikirim', 'ditolak', 'dibatalkan', 'disetujui') NOT NULL DEFAULT 'pending'");
        
        // 2. Add new columns
        Schema::table('donation_requests', function (Blueprint $table) {
            $table->string('bukti_pembayaran')->nullable()->after('status');
            $table->string('resi_pengiriman')->nullable()->after('bukti_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donation_requests', function (Blueprint $table) {
            //
        });
    }
};
