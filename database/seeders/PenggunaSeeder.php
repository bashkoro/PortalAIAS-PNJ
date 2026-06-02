<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = DB::table('hak_akses')->where('nama_hak_akses', 'Admin')->first();
        $dosenRole = DB::table('hak_akses')->where('nama_hak_akses', 'Dosen')->first();
        $mahasiswaRole = DB::table('hak_akses')->where('nama_hak_akses', 'Mahasiswa')->first();

        $programStudi = DB::table('program_studi')->first();

        if ($adminRole && $dosenRole && $mahasiswaRole && $programStudi) {
            DB::table('pengguna')->insert([
                [
                    'hak_akses_id' => $adminRole->id,
                    'program_studi_id' => $programStudi->id,
                    'nama' => 'Admin AIAS',
                    'email' => 'admin@pnj.ac.id',
                    'password' => Hash::make('password'),
                ],
                [
                    'hak_akses_id' => $dosenRole->id,
                    'program_studi_id' => $programStudi->id,
                    'nama' => 'Dosen Tester',
                    'email' => 'dosen@pnj.ac.id',
                    'password' => Hash::make('password'),
                ],
                [
                    'hak_akses_id' => $mahasiswaRole->id,
                    'program_studi_id' => $programStudi->id,
                    'nama' => 'Mahasiswa Tester',
                    'email' => 'mhs@pnj.ac.id',
                    'password' => Hash::make('password'),
                ],
            ]);
        }
    }
}
