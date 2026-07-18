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
        // Add 'arsip' to the enum
        DB::statement("ALTER TABLE donation_items MODIFY COLUMN status ENUM('tersedia', 'disalurkan', 'arsip') DEFAULT 'tersedia'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE donation_items MODIFY COLUMN status ENUM('tersedia', 'disalurkan') DEFAULT 'tersedia'");
    }
};
