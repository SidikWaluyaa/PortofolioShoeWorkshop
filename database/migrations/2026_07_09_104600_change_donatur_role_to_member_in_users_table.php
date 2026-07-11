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
        // Update all users who have the role 'donatur' to 'member'
        DB::table('users')
            ->where('role', 'donatur')
            ->update(['role' => 'member']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert users from 'member' to 'donatur'
        DB::table('users')
            ->where('role', 'member')
            ->update(['role' => 'donatur']);
    }
};
