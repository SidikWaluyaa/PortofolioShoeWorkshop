<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Alter status enum to include 'disetujui'
        DB::statement("ALTER TABLE donations MODIFY COLUMN status ENUM('pending', 'disetujui', 'diterima', 'disalurkan', 'ditolak', 'siap_rilis', 'masuk_katalog') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert status enum back if possible (will fail if data contains 'disetujui')
        DB::statement("ALTER TABLE donations MODIFY COLUMN status ENUM('pending', 'diterima', 'disalurkan', 'ditolak', 'siap_rilis', 'masuk_katalog') DEFAULT 'pending'");
    }
};
