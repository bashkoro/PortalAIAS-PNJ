<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MataKuliahSeeder extends Seeder
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
        
        $insertedCount = 0;

        foreach ($courses as $course) {
            $prodiName = $course['Program_Studi'];
            $mkName = $course['Mata_Kuliah_Clean'];

            // Lewati jika data esensial hilang
            if (empty($prodiName) || empty($mkName)) {
                continue;
            }

            // Mencari ID ProgramStudi
            $prodi = DB::table('program_studi')
                ->where('nama_prodi', $prodiName)
                ->first();

            if (!$prodi) {
                continue; // Lewati jika ProgramStudi tidak ditemukan
            }

            // Membuat kode dummy sederhana (misal: huruf pertama + angka acak)
            $words = explode(' ', $mkName);
            $acronym = '';
            foreach ($words as $word) {
                if (!empty($word)) {
                    // Hanya ambil karakter alfanumerik untuk akronim
                    $cleanWord = preg_replace('/[^a-zA-Z0-9]/', '', $word);
                    if (!empty($cleanWord)) {
                        $acronym .= strtoupper(substr($cleanWord, 0, 1));
                    }
                }
            }
            
            $baseCode = $prodi->kode_prodi . '-' . $acronym;
            $randomNumber = rand(100, 999);
            
            // Batas kolom adalah 20 karakter. Kita butuh 4 karakter untuk "-999".
            // Jadi kode dasar maksimal 16 karakter.
            if (strlen($baseCode) > 16) {
                $baseCode = substr($baseCode, 0, 16);
            }
            
            $kodeMk = $baseCode . '-' . $randomNumber;

            // Masukkan menggunakan DB facade untuk meniru perilaku firstOrCreate tanpa model
            $exists = DB::table('mata_kuliah')
                ->where('program_studi_id', $prodi->id)
                ->where('nama_mk', $mkName)
                ->exists();

            if (!$exists) {
                DB::table('mata_kuliah')->insert([
                    'program_studi_id' => $prodi->id,
                    'kode_mk' => $kodeMk,
                    'nama_mk' => $mkName,
                ]);
                $insertedCount++;
            }
        }
        
        $this->command->info("Seeded {$insertedCount} unique Mata Kuliah.");
    }
}
