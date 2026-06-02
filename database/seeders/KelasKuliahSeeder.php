<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasKuliahSeeder extends Seeder
{
    public function run(): void
    {
        $periode = DB::table('periode_akademik')->where('nama_periode', 'Genap 2025/2026')->first();
        $mkAi = DB::table('mata_kuliah')->where('kode_mk', 'MK-AI01')->first();
        $mkSp = DB::table('mata_kuliah')->where('kode_mk', 'MK-SP02')->first();
        $dosen = DB::table('pengguna')->where('email', 'dosen@pnj.ac.id')->first();

        if ($periode && $mkAi && $mkSp && $dosen) {
            DB::table('kelas_kuliah')->insert([
                [
                    'nama_kelas' => 'TI-8A',
                    'mata_kuliah_id' => $mkAi->id,
                    'periode_akademik_id' => $periode->id,
                    'dosen_id' => $dosen->id,
                ],
                [
                    'nama_kelas' => 'TI-8B',
                    'mata_kuliah_id' => $mkSp->id,
                    'periode_akademik_id' => $periode->id,
                    'dosen_id' => $dosen->id,
                ],
            ]);
        }
    }
}
