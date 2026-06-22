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
    
    public function run(): void
    {
        // Kudu csv ya adik adik
        $filePath = database_path('data/Data Dosen PNJ.csv');
        
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

        // Default pass
        $defaultPassword = Hash::make('dosen1234');
        
        $count = 0;
        $row = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $row++;
            // Skip baris pertama
            if ($row <= 2) {
                continue;
            }

            // Index 3: NAMA DOSEN, Index 4: PRODI
            if (!isset($data[3]) || !isset($data[4])) continue;

            $rawName = $data[3];
            $prodiName = $data[4];

            if (empty(trim($rawName))) continue;

            // 1. Manggil fungsi cleaname
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

            // 4. Nyari id prodi
            $programStudi = ProgramStudi::where('nama_prodi', 'LIKE', "%{$prodiName}%")
                ->orWhere('nama_prodi', $prodiName)
                ->first();

            if (!$programStudi) {
                $programStudi = ProgramStudi::first(); 
            }

            // 5. Masukkk
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
        // Ngilangin gelar
        $parts = explode(',', $name);
        $name = trim($parts[0]);

        // Ngilangin gelar depan
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

    // Buat emeil
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
