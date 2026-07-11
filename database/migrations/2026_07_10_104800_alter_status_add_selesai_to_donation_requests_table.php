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
        DB::statement("ALTER TABLE donation_requests MODIFY COLUMN status ENUM('pending', 'menunggu_pembayaran', 'menunggu_verifikasi', 'diproses', 'dikirim', 'ditolak', 'dibatalkan', 'disetujui', 'selesai') NOT NULL DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE donation_requests MODIFY COLUMN status ENUM('pending', 'menunggu_pembayaran', 'menunggu_verifikasi', 'diproses', 'dikirim', 'ditolak', 'dibatalkan', 'disetujui') NOT NULL DEFAULT 'pending'");
    }
};
