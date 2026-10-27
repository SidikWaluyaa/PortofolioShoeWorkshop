<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Links an article to a shoe problem in the home page "Klinik Sepatu" picker.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('keluhan', 50)->nullable()->after('category');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('keluhan');
        });
    }
};
