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
        Schema::table('riwayat_prompt', function (Blueprint $table) {
            $table->string('link_conversation')->nullable()->after('respons_ai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('riwayat_prompt', function (Blueprint $table) {
            $table->dropColumn('link_conversation');
        });
    }
};
