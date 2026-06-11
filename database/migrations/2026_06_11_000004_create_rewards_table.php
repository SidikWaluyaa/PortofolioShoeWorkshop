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
        Schema::create('rewards', function (Blueprint $table) {
            $table->id();
            $table->string('nama_reward', 150);
            $table->enum('jenis', ['voucher', 'diskon', 'konsultasi', 'lainnya'])->default('voucher');
            $table->text('deskripsi');
            $table->string('kode_kupon', 50)->nullable();
            $table->string('nilai', 50)->nullable();
            $table->boolean('status_aktif')->default(true)->index();
            $table->unsignedInteger('minggu_ke')->index();
            $table->date('berlaku_dari')->nullable();
            $table->date('berlaku_sampai')->nullable();
            $table->integer('stok')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
