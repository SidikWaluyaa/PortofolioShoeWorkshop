<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add 'dipesan': the shoe is hidden from the catalog while its first payer waits for admin verification.
     */
    public function up(): void
    {
        $this->setStatuses(['tersedia', 'dipesan', 'disalurkan', 'arsip']);

        // Items the old flow marked 'disalurkan' while the payment was still unverified are really 'dipesan'.
        DB::table('donation_items')
            ->where('status', 'disalurkan')
            ->whereIn('id', DB::table('donation_requests')->where('status', 'menunggu_verifikasi')->select('donation_item_id'))
            ->update(['status' => 'dipesan']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('donation_items')->where('status', 'dipesan')->update(['status' => 'disalurkan']);

        $this->setStatuses(['tersedia', 'disalurkan', 'arsip']);
    }

    private function setStatuses(array $statuses): void
    {
        if (DB::getDriverName() === 'mysql') {
            $list = "'" . implode("', '", $statuses) . "'";
            DB::statement("ALTER TABLE donation_items MODIFY COLUMN status ENUM($list) DEFAULT 'tersedia'");
            return;
        }

        Schema::table('donation_items', function (Blueprint $table) use ($statuses) {
            $table->enum('status', $statuses)->default('tersedia')->change();
        });
    }
};
