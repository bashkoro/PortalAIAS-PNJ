<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftaranKelasSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswa = DB::table('pengguna')->where('email', 'mhs@pnj.ac.id')->first();
        
        $kelasTi8a = DB::table('kelas_kuliah')->where('nama_kelas', 'TI-8A')->first();
        $kelasTi8b = DB::table('kelas_kuliah')->where('nama_kelas', 'TI-8B')->first();

        if ($mahasiswa && $kelasTi8a && $kelasTi8b) {
            DB::table('pendaftaran_kelas')->insert([
                [
                    'kelas_kuliah_id' => $kelasTi8a->id,
                    'mahasiswa_id' => $mahasiswa->id,
                ],
                [
                    'kelas_kuliah_id' => $kelasTi8b->id,
                    'mahasiswa_id' => $mahasiswa->id,
                ],
            ]);
        }
    }
}
