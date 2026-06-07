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

            // Skip if essential data is missing
            if (empty($prodiName) || empty($mkName)) {
                continue;
            }

            // Find ProgramStudi ID
            $prodi = DB::table('program_studi')
                ->where('nama_prodi', $prodiName)
                ->first();

            if (!$prodi) {
                continue; // Skip if ProgramStudi not found
            }

            // Generate a simple dummy code (e.g., first letters + random number)
            $words = explode(' ', $mkName);
            $acronym = '';
            foreach ($words as $word) {
                if (!empty($word)) {
                    // Only take alphanumeric characters for the acronym
                    $cleanWord = preg_replace('/[^a-zA-Z0-9]/', '', $word);
                    if (!empty($cleanWord)) {
                        $acronym .= strtoupper(substr($cleanWord, 0, 1));
                    }
                }
            }
            
            $baseCode = $prodi->kode_prodi . '-' . $acronym;
            $randomNumber = rand(100, 999);
            
            // The column limit is 20 chars. We need 4 chars for "-999".
            // So the base code can be at most 16 chars.
            if (strlen($baseCode) > 16) {
                $baseCode = substr($baseCode, 0, 16);
            }
            
            $kodeMk = $baseCode . '-' . $randomNumber;

            // Insert using DB facade to emulate firstOrCreate behavior without models
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
