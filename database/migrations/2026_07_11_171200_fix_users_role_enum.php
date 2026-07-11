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
        // Fix the ENUM column to include all roles
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('admin', 'user', 'member', 'donatur') DEFAULT 'member'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Downgrading ENUM is risky if data exists, so we leave it or make it string
        DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(50) DEFAULT 'user'");
    }
};
