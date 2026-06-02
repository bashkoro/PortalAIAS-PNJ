<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $programStudi = DB::table('program_studi')->where('kode_prodi', 'IF')->first();
        
        if (!$programStudi) {
            $programStudiId = DB::table('program_studi')->insertGetId([
                'kode_prodi' => 'IF',
                'nama_prodi' => 'Teknik Informatika'
            ]);
        } else {
            $programStudiId = $programStudi->id;
        }

        DB::table('mata_kuliah')->insert([
            [
                'kode_mk' => 'MK-AI01',
                'nama_mk' => 'Kecerdasan Buatan',
                'program_studi_id' => $programStudiId,
            ],
            [
                'kode_mk' => 'MK-SP02',
                'nama_mk' => 'Sistem Pakar',
                'program_studi_id' => $programStudiId,
            ],
        ]);
    }
}
