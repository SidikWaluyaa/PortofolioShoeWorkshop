<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Invoices issued under "siapa cepat dia dapat" before curation became the default have no payment
 * deadline and don't hold the shoe, so curation mode can't take payment for them. Unpaid ones go back
 * to curation ('pending') so the admin can choose the recipient like any other request.
 */
return new class extends Migration
{
    public function up(): void
    {
        $mode = DB::table('settings')->where('key', 'adoption_mode')->value('value');
        if ($mode === 'cepat') {
            return;
        }

        DB::table('donation_requests')
            ->where('status', 'menunggu_pembayaran')
            ->whereNull('batas_bayar')
            ->whereNull('bukti_pembayaran')
            ->update(['status' => 'pending', 'updated_at' => now()]);
    }

    public function down(): void
    {
        // One-way data fix: the moved requests can't be told apart from genuine pending ones
    }
};
