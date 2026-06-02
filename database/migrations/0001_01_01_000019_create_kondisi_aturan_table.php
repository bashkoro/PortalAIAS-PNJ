<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kondisi_aturan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aturan_id')->constrained('aturan')->cascadeOnDelete();
            $table->string('nama_parameter', 50)->nullable();
            $table->string('operator', 10)->nullable();
            $table->string('target_value', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kondisi_aturan');
    }
};
