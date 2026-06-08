<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use App\Models\HakAkses;
use App\Models\ProgramStudi;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DosenPnjSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Note: This seeder expects a CSV file. If your file is a real .xlsx, 
     * please export it to CSV (comma separated) before running.
     */
    public function run(): void
    {
        $filePath = database_path('data/Data Dosen PNJ.csv');
        
        // Even if named .xlsx, we'll try to read it as CSV if possible, 
        // but typically this will fail for real Excel files.
        if (!file_exists($filePath)) {
            $this->command->error("File not found: {$filePath}");
            return;
        }

        $handle = fopen($filePath, 'r');
        if (!$handle) {
            $this->command->error("Could not open file: {$filePath}");
            return;
        }

        $hakAksesDosen = HakAkses::where('nama_hak_akses', 'Dosen')->first();
        if (!$hakAksesDosen) {
            $this->command->error("Hak Akses 'Dosen' not found in database.");
            return;
        }

        // Cache password hash to avoid running Hash::make in the loop, which is very slow
        $defaultPassword = Hash::make('dosen1234');
        
        $count = 0;
        $row = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $row++;
            // Skip the first row "SISTER..." and the header row "NO.,NIDN..."
            if ($row <= 2) {
                continue;
            }

            // Index 3: NAMA DOSEN, Index 4: PRODI
            if (!isset($data[3]) || !isset($data[4])) continue;

            $rawName = $data[3];
            $prodiName = $data[4];

            if (empty(trim($rawName))) continue;

            // 1. Name Cleaning
            $cleanName = $this->cleanName($rawName);
            
            // 2. Email Prefix
            $emailPrefix = Str::of($cleanName)
                ->lower()
                ->trim()
                ->replace(' ', '.')
                ->toString();

            // 3. Subdomain Mapping
            $domain = $this->getDomain($prodiName);
            $email = $emailPrefix . $domain;

            // 4. Find Program Studi ID
            $programStudi = ProgramStudi::where('nama_prodi', 'LIKE', "%{$prodiName}%")
                ->orWhere('nama_prodi', $prodiName)
                ->first();

            if (!$programStudi) {
                $programStudi = ProgramStudi::first(); 
            }

            // 5. Insertion
            if (!Pengguna::where('email', $email)->exists()) {
                Pengguna::create([
                    'nama' => $rawName, // Original name for display
                    'email' => $email,
                    'password' => $defaultPassword,
                    'hak_akses_id' => $hakAksesDosen->id,
                    'program_studi_id' => $programStudi->id,
                ]);
                $count++;
            }
        }

        fclose($handle);
        $this->command->info("Seeded {$count} Dosen accounts.");
    }

    private function cleanName(string $name): string
    {
        // Strip titles after the comma
        $parts = explode(',', $name);
        $name = trim($parts[0]);

        // Strip common prefixes repeatedly
        $prefixes = ['Dr. ', 'Dra. ', 'Drs. ', 'Ir. ', 'Prof. '];
        $changed = true;
        while ($changed) {
            $changed = false;
            foreach ($prefixes as $prefix) {
                if (stripos($name, $prefix) === 0) {
                    $name = trim(substr($name, strlen($prefix)));
                    $changed = true;
                }
            }
        }

        return trim($name);
    }

    private function getDomain(string $prodi): string
    {
        if (Str::contains($prodi, ['Administrasi', 'Konvensi', 'Komunikasi Bisnis'])) {
            return '@bisnis.pnj.ac.id';
        }
        if (Str::contains($prodi, ['Akuntansi', 'Keuangan', 'Pemasaran'])) {
            return '@akuntansi.pnj.ac.id';
        }
        if (Str::contains($prodi, ['Manufaktur S2', 'Elektro S2'])) {
            return '@pascasarjana.pnj.ac.id';
        }
        if (Str::contains($prodi, ['Broadband', 'Instrumentasi', 'Elektronika', 'Listrik', 'Telekomunikasi'])) {
            return '@elektro.pnj.ac.id';
        }
        if (Str::contains($prodi, ['Grafis', 'Penerbitan', 'Jurnalistik', 'Cetak'])) {
            return '@grafika.pnj.ac.id';
        }
        if (Str::contains($prodi, ['Informatika', 'Komputer', 'Multimedia'])) {
            return '@tik.pnj.ac.id';
        }
        if (Str::contains($prodi, ['Alat Berat', 'Konversi Energi', 'Manufaktur D4', 'Pembangkit', 'Mesin', 'RESD'])) {
            return '@mesin.pnj.ac.id';
        }
        if (Str::contains($prodi, ['Konstruksi', 'Sipil', 'Jalan'])) {
            return '@sipil.pnj.ac.id';
        }

        return '@pnj.ac.id';
    }
}
