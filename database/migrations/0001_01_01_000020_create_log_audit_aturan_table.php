<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_audit_aturan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aturan_id')->constrained('aturan')->cascadeOnDelete();
            $table->foreignId('admin_id')->constrained('pengguna')->cascadeOnDelete();
            $table->string('jenis_aksi', 50)->nullable();
            $table->jsonb('nilai_lama')->nullable();
            $table->jsonb('nilai_baru')->nullable();
            $table->timestamp('waktu_aksi')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_audit_aturan');
    }
};
