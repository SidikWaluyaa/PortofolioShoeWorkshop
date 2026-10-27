<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Extra details printed on the "nota" testimonial cards.
     */
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->string('service', 100)->nullable()->after('location');
            $table->string('source', 20)->default('manual')->after('service'); // manual | google
            $table->date('reviewed_at')->nullable()->after('source');
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropColumn(['service', 'source', 'reviewed_at']);
        });
    }
};
