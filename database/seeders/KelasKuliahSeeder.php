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
        // 1. Setup Active Period
        $periode = DB::table('periode_akademik')->where('is_active', true)->first();
        if (!$periode) {
            $this->command->error("No active Periode Akademik found.");
            return;
        }

        // --- STEP A: Specific Testing Class ---
        
        $dosenTester = DB::table('pengguna')->where('nama', 'Dosen Tester')->first();
        if (!$dosenTester) {
            $this->command->error("Dosen Tester not found.");
            return;
        }

        $prodi = DB::table('program_studi')->first();
        
        // Fetch or create Matakuliah Testing
        $mkTestingId = DB::table('mata_kuliah')->updateOrInsert(
            ['nama_mk' => 'Matakuliah Testing', 'program_studi_id' => $prodi->id],
            ['kode_mk' => 'TEST-001']
        );
        $mkTesting = DB::table('mata_kuliah')->where('nama_mk', 'Matakuliah Testing')->first();

        // Create Kelas Testing assigned to Dosen Tester
        DB::table('kelas_kuliah')->updateOrInsert(
            [
                'nama_kelas' => 'Kelas Testing', 
                'mata_kuliah_id' => $mkTesting->id,
                'periode_akademik_id' => $periode->id
            ],
            ['dosen_id' => $dosenTester->id]
        );

        // --- STEP B: JSON Scraped Classes (Unassigned) ---

        $jsonPath = database_path('data/courses_cleaned.json');
        if (!File::exists($jsonPath)) {
            $this->command->error("File courses_cleaned.json not found.");
            return;
        }

        $jsonData = File::get($jsonPath);
        $courses = json_decode($jsonData, true);
        $insertedCount = 0;

        foreach ($courses as $course) {
            $prodiName = $course['Program_Studi'];
            $mkName = $course['Mata_Kuliah_Clean'];
            $kelasName = $course['Kelas_Clean'];

            if (empty($prodiName) || empty($mkName) || empty($kelasName)) continue;

            $prodiRecord = DB::table('program_studi')->where('nama_prodi', $prodiName)->first();
            if (!$prodiRecord) continue;

            $mataKuliah = DB::table('mata_kuliah')
                ->where('nama_mk', $mkName)
                ->where('program_studi_id', $prodiRecord->id)
                ->first();

            if (!$mataKuliah) continue;

            // Insert as NULL (unassigned)
            $exists = DB::table('kelas_kuliah')
                ->where('mata_kuliah_id', $mataKuliah->id)
                ->where('nama_kelas', $kelasName)
                ->where('periode_akademik_id', $periode->id)
                ->exists();

            if (!$exists) {
                DB::table('kelas_kuliah')->insert([
                    'mata_kuliah_id' => $mataKuliah->id,
                    'nama_kelas' => $kelasName,
                    'dosen_id' => null, // Explicitly set to NULL
                    'periode_akademik_id' => $periode->id,
                ]);
                $insertedCount++;
            }
        }

        $this->command->info("Seeded Kelas Testing for Dosen Tester.");
        $this->command->info("Seeded {$insertedCount} unassigned Kelas Kuliah from JSON.");
    }
}
