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
        Schema::create('daily_logins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->date('tanggal_checkin');
            $table->string('foto_sepatu_path', 255);
            $table->unsignedInteger('minggu_ke');
            $table->unsignedTinyInteger('hari_ke'); // 1-7
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->index();
            $table->boolean('reward_claimed')->default(false);
            $table->timestamp('created_at')->useCurrent();

            // Prevent double check-in on the same day
            $table->unique(['user_id', 'tanggal_checkin'], 'uq_user_tanggal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_logins');
    }
};
