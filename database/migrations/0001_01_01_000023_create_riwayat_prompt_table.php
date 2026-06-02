<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_prompt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deklarasi_id')->constrained('deklarasi')->cascadeOnDelete();
            $table->string('nama_platform_ai', 50)->nullable();
            $table->text('prompt_dikirim')->nullable();
            $table->text('respons_ai')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_prompt');
    }
};
