<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_kuliah_id')->constrained('kelas_kuliah')->cascadeOnDelete();
            $table->string('judul', 100)->nullable();
            $table->text('deskripsi')->nullable();
            $table->foreignId('tingkat_aias_akhir_id')->constrained('tingkat_aias')->cascadeOnDelete();
            $table->jsonb('kriteria_tugas')->nullable();
            $table->string('status_publikasi', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
