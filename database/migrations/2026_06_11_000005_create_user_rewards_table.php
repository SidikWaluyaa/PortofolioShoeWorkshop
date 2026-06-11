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
        Schema::create('user_rewards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('reward_id')->constrained('rewards')->cascadeOnDelete();
            $table->unsignedInteger('minggu_ke');
            $table->string('unique_code', 50)->nullable()->unique();
            $table->timestamp('claimed_at')->useCurrent();

            // Prevent double claiming same reward in same week
            $table->unique(['user_id', 'reward_id', 'minggu_ke'], 'uq_user_reward_minggu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_rewards');
    }
};
