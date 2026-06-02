<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStudiSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('program_studi')->insert([
            [
                'kode_prodi' => 'IF',
                'nama_prodi' => 'Teknik Informatika',
            ],
            [
                'kode_prodi' => 'SI',
                'nama_prodi' => 'Sistem Informasi',
            ],
            [
                'kode_prodi' => 'TE',
                'nama_prodi' => 'Teknik Elektro',
            ],
        ]);
    }
}
