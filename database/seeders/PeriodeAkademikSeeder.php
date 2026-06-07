<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeriodeAkademikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('periode_akademik')->insert([
            'nama_periode' => '2025/2026 Genap',
            'is_active' => true,
        ]);
    }
}