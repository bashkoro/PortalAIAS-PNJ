<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PendaftaranKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswaRole = DB::table('hak_akses')->where('nama_hak_akses', 'Mahasiswa')->first();
        
        if (!$mahasiswaRole) {
            $this->command->error("Mahasiswa role not found in hak_akses table.");
            return;
        }

        $mahasiswas = DB::table('pengguna')
            ->where('hak_akses_id', $mahasiswaRole->id)
            ->get();

        if ($mahasiswas->isEmpty()) {
            $this->command->error("No users with Mahasiswa role found.");
            return;
        }

        $insertedCount = 0;

        foreach ($mahasiswas as $mhs) {
            $prodiId = $mhs->program_studi_id;

            if (!$prodiId) {
                continue;
            }

            // Find all classes that belong to the student's program studi
            // by joining kelas_kuliah with mata_kuliah
            $availableClasses = DB::table('kelas_kuliah')
                ->join('mata_kuliah', 'kelas_kuliah.mata_kuliah_id', '=', 'mata_kuliah.id')
                ->where('mata_kuliah.program_studi_id', $prodiId)
                ->select('kelas_kuliah.id')
                ->pluck('id')
                ->toArray();

            if (empty($availableClasses)) {
                continue;
            }

            // Shuffle and pick up to 3 classes
            shuffle($availableClasses);
            $classesToEnroll = array_slice($availableClasses, 0, min(3, count($availableClasses)));

            foreach ($classesToEnroll as $kelasId) {
                $exists = DB::table('pendaftaran_kelas')
                    ->where('mahasiswa_id', $mhs->id)
                    ->where('kelas_kuliah_id', $kelasId)
                    ->exists();

                if (!$exists) {
                    DB::table('pendaftaran_kelas')->insert([
                        'mahasiswa_id' => $mhs->id,
                        'kelas_kuliah_id' => $kelasId,
                    ]);
                    $insertedCount++;
                }
            }
        }

        $this->command->info("Seeded {$insertedCount} Pendaftaran Kelas records.");
    }
}
