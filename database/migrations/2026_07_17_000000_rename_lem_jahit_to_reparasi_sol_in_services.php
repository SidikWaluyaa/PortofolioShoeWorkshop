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
        DB::table('services')
            ->where('name', 'Lem & Jahit')
            ->update(['name' => 'Reparasi Sol']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('services')
            ->where('name', 'Reparasi Sol')
            ->update(['name' => 'Lem & Jahit']);
    }
};
