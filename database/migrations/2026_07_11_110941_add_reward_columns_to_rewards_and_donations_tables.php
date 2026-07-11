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
        Schema::table('rewards', function (Blueprint $table) {
            $table->string('kategori_reward')->default('daily_checkin')->after('id');
            // minggu_ke can be nullable now if kategori_reward is donasi
            $table->integer('minggu_ke')->nullable()->change();
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->boolean('is_reward_claimed')->default(false)->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rewards', function (Blueprint $table) {
            $table->dropColumn('kategori_reward');
            $table->integer('minggu_ke')->nullable(false)->change();
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn('is_reward_claimed');
        });
    }
};
