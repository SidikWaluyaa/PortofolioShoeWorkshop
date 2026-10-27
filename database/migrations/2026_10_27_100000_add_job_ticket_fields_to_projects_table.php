<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Fields shown on the "kartu SPK" portfolio card on the home page.
     */
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('spk_number', 50)->nullable()->after('category');
            $table->string('keluhan')->nullable()->after('description');
            $table->text('tindakan')->nullable()->after('keluhan'); // one action per line
            $table->unsignedSmallInteger('durasi_hari')->nullable()->after('tindakan');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['spk_number', 'keluhan', 'tindakan', 'durasi_hari']);
        });
    }
};
