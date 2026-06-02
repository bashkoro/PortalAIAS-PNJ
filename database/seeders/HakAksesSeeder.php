<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HakAksesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hak_akses')->insert([
            ['nama_hak_akses' => 'Admin'],
            ['nama_hak_akses' => 'Dosen'],
            ['nama_hak_akses' => 'Mahasiswa'],
        ]);
    }
}
