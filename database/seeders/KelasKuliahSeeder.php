<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class KelasKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('data/courses_cleaned.json');
        
        if (!File::exists($jsonPath)) {
            $this->command->error("File courses_cleaned.json not found at {$jsonPath}");
            return;
        }

        $jsonData = File::get($jsonPath);
        $courses = json_decode($jsonData, true);

        // Fetch the first active PeriodeAkademik
        $periode = DB::table('periode_akademik')->where('is_active', true)->first();
        if (!$periode) {
            $this->command->error("No active Periode Akademik found. Please seed it first.");
            return;
        }

        // Fetch Dosen IDs
        $dosenRole = DB::table('hak_akses')->where('nama_hak_akses', 'Dosen')->first();
        if (!$dosenRole) {
            $this->command->error("Dosen role not found in hak_akses table.");
            return;
        }

        $dosenIds = DB::table('pengguna')
            ->where('hak_akses_id', $dosenRole->id)
            ->pluck('id')
            ->toArray();

        if (empty($dosenIds)) {
            $this->command->error("No users with Dosen role found. Please seed them first.");
            return;
        }

        $insertedCount = 0;

        foreach ($courses as $course) {
            $prodiName = $course['Program_Studi'];
            $mkName = $course['Mata_Kuliah_Clean'];
            $kelasName = $course['Kelas_Clean'];

            if (empty($prodiName) || empty($mkName) || empty($kelasName)) {
                continue;
            }

            $prodi = DB::table('program_studi')->where('nama_prodi', $prodiName)->first();
            if (!$prodi) {
                continue;
            }

            $mataKuliah = DB::table('mata_kuliah')
                ->where('nama_mk', $mkName)
                ->where('program_studi_id', $prodi->id)
                ->first();

            if (!$mataKuliah) {
                continue;
            }

            $randomDosenId = $dosenIds[array_rand($dosenIds)];

            // Emulate firstOrCreate
            $exists = DB::table('kelas_kuliah')
                ->where('mata_kuliah_id', $mataKuliah->id)
                ->where('nama_kelas', $kelasName)
                ->where('periode_akademik_id', $periode->id)
                ->exists();

            if (!$exists) {
                DB::table('kelas_kuliah')->insert([
                    'mata_kuliah_id' => $mataKuliah->id,
                    'nama_kelas' => $kelasName,
                    'dosen_id' => $randomDosenId,
                    'periode_akademik_id' => $periode->id,
                ]);
                $insertedCount++;
            }
        }

        $this->command->info("Seeded {$insertedCount} unique Kelas Kuliah.");
    }
}
