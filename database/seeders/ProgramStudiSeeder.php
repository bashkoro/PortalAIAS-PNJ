<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramStudiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $programs = [
            'Administrasi Bisnis D3',
            'Administrasi Bisnis D4',
            'MICE D4',
            'MICE D4 PDSKU Demak',
            'Akuntansi D3',
            'Akuntansi D4',
            'Keuangan dan Perbankan D3',
            'Keuangan dan Perbankan D4',
            'Keuangan dan Perbankan Syariah D4',
            'Manajemen Keuangan D4',
            'Manajemen Pemasaran D3',
            'Bahasa Inggris untuk Komunikasi Bisnis dan Profesional D4',
            'Magister Terapan Rekayasa Teknologi Manufaktur S2',
            'Magister Terapan Teknik Elektro S2',
            'Broadband Multimmedia D4',
            'Instrumentasi dan Kontrol Industri D4',
            'Teknik Elektronika Industri D3',
            'Teknik Listrik D3',
            'Teknik Otomasi Listrik Industri D4',
            'Teknik Telekomunikasi D3',
            'Desain Grafis D4',
            'Penerbitan / Jurnalistik D3',
            'Teknologi Rekayasa Cetak dan Grafis 3D D4',
            'Teknologi Industri Cetak Kemasan D4',
            'Teknik Informatika D4',
            'Teknik Komputer Jaringan D1',
            'Teknik Multimedia dan Jaringan D4',
            'Teknik Multimedia Digital D4',
            'Alat Berat D4',
            'Konversi Energi D4',
            'Teknologi Rekayasa Manufaktur D4',
            'Teknologi Rekayasa Pembangkit Energi D4',
            'Teknik Mesin D3',
            'Teknik Mesin D3 PSDKU Demak',
            'Renewable Energy Skills Development (RESD)',
            'Konstruksi Gedung D3',
            'Konstruksi Gedung D4',
            'Konstruksi Sipil D3',
            'Teknik Perancangan Jalan Dan Jembatan D4'
        ];

        $insertData = [];

        foreach ($programs as $program) {
            $insertData[] = [
                'kode_prodi' => $this->generateAcronym($program),
                'nama_prodi' => $program,
            ];
        }

        DB::table('program_studi')->insert($insertData);
    }

    /**
     * Helper function to generate an acronym.
     * E.g., 'Administrasi Bisnis D3' -> 'AB-D3'
     */
    private function generateAcronym(string $string): string
    {
        // Special case handling for RESD
        if (str_contains($string, '(RESD)')) {
            return 'RESD';
        }

        $words = explode(' ', $string);
        $acronym = '';
        $degree = '';

        foreach ($words as $word) {
            // Check if the word is a degree indicator (D1, D3, D4, S2)
            if (preg_match('/^(D[134]|S2)$/', $word)) {
                $degree = '-' . $word;
                continue;
            }

            // Ignore common conjunctions/prepositions
            if (in_array(strtolower($word), ['dan', 'untuk', 'atau'])) {
                continue;
            }

            // Take the first letter of other words
            if (!empty($word)) {
                $acronym .= strtoupper(substr($word, 0, 1));
            }
        }

        return $acronym . $degree;
    }
}