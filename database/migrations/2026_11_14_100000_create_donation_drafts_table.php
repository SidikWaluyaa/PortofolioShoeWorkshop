<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * A donation filled in before the donor has an account. It is kept until the donor signs in or registers,
 * then sent as a normal donation. Unsent drafts are removed after 7 days.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('donation_drafts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
            $table->json('data');
            $table->json('foto_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('donation_drafts');
    }
};
