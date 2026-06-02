<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeAkademikSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('periode_akademik')->insert([
            [
                'nama_periode' => 'Genap 2025/2026',
                'is_active' => true,
            ],
            [
                'nama_periode' => 'Ganjil 2025/2026',
                'is_active' => false,
            ],
        ]);
    }
}
