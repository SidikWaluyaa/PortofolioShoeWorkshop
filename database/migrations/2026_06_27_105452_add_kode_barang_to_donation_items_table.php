<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('donation_items', function (Blueprint $table) {
            $table->string('kode_barang', 50)->nullable()->unique()->after('id');
        });

        // Backfill existing data
        $items = Illuminate\Support\Facades\DB::table('donation_items')->get();
        foreach ($items as $item) {
            $suffix = [
                'sepatu' => 'DS',
                'tas' => 'DT',
                'topi' => 'DP',
            ][$item->kategori] ?? 'DS';

            $code = str_pad($item->id, 3, '0', STR_PAD_LEFT) . '-' . $suffix;

            Illuminate\Support\Facades\DB::table('donation_items')
                ->where('id', $item->id)
                ->update(['kode_barang' => $code]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donation_items', function (Blueprint $table) {
            $table->dropColumn('kode_barang');
        });
    }
};
