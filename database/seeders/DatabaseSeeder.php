<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            ProgramStudiSeeder::class,
            HakAksesSeeder::class,
            TingkatAiasSeeder::class,
            AturanSeeder::class,
            PenggunaSeeder::class,
            PeriodeAkademikSeeder::class,
            MataKuliahSeeder::class,
            KelasKuliahSeeder::class,
            PendaftaranKelasSeeder::class,
        ]);
    }
}
