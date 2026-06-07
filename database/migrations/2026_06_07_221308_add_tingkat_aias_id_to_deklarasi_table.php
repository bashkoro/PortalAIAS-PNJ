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
        Schema::table('deklarasi', function (Blueprint $table) {
            $table->foreignId('tingkat_aias_id')->nullable()->constrained('tingkat_aias')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('deklarasi', function (Blueprint $table) {
            $table->dropForeign(['tingkat_aias_id']);
            $table->dropColumn('tingkat_aias_id');
        });
    }
};
