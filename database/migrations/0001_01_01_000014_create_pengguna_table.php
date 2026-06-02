<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hak_akses_id')->constrained('hak_akses')->cascadeOnDelete();
            $table->foreignId('program_studi_id')->constrained('program_studi')->cascadeOnDelete();
            $table->string('nama', 100);
            $table->string('email', 100)->unique();
            $table->string('password', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
