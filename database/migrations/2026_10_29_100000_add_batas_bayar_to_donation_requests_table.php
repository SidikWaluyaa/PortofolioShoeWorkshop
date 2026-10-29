<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Adoption by admin curation: the chosen requester gets a payment deadline, and the
 * adoption mode becomes a setting so management can switch back to "siapa cepat dia dapat".
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donation_requests', function (Blueprint $table) {
            $table->timestamp('batas_bayar')->nullable()->after('status');
        });

        DB::table('settings')->insertOrIgnore([
            'key' => 'adoption_mode',
            'value' => 'kurasi',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::table('donation_requests', function (Blueprint $table) {
            $table->dropColumn('batas_bayar');
        });

        DB::table('settings')->where('key', 'adoption_mode')->delete();
    }
};
