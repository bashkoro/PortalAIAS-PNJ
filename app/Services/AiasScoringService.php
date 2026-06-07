<?php

namespace App\Services;

class AiasScoringService
{
    /**
     * Calculate the AIAS Level based on provided parameters.
     *
     * @param array{
     *   lingkungan: string,
     *   kognitif: string,
     *   pengetahuan: string,
     *   kompleksitas: string,
     *   konteks: string,
     *   evaluasi: string
     * } $inputs
     * @return int
     */
    public function calculateLevel(array $inputs): int
    {
        // Rule A (Controlled Environment)
        if ($inputs['lingkungan'] === 'Terkendali Penuh / Terawasi') {
            if (
                $inputs['kognitif'] === 'Mencipta (Creating)' || 
                $inputs['pengetahuan'] === 'Pengetahuan Metakognitif'
            ) {
                return 2;
            }
            
            return 1;
        }

        // Rule B (Open Environment)
        $score = 0;
        
        $score += $this->getKognitifScore($inputs['kognitif']);
        $score += $this->getPengetahuanScore($inputs['pengetahuan']);
        $score += $this->getKompleksitasScore($inputs['kompleksitas']);
        $score += $this->getKonteksScore($inputs['konteks']);
        $score += $this->getEvaluasiScore($inputs['evaluasi']);

        if ($score >= 12) {
            return 5;
        }
        
        if ($score >= 8) {
            return 4;
        }
        
        if ($score >= 4) {
            return 3;
        }
        
        return 2;
    }

    private function getKognitifScore(string $value): int
    {
        return match (true) {
            str_contains($value, 'Mengingat') => 5,
            str_contains($value, 'Memahami') => 4,
            str_contains($value, 'Mengaplikasikan') => 3,
            str_contains($value, 'Menganalisis') => 2,
            str_contains($value, 'Mengevaluasi') => 1,
            str_contains($value, 'Mencipta') => 0,
            default => 0,
        };
    }

    private function getPengetahuanScore(string $value): int
    {
        return match (true) {
            str_contains($value, 'Faktual') => 3,
            str_contains($value, 'Konseptual') => 2,
            str_contains($value, 'Prosedural') => 1,
            str_contains($value, 'Metakognitif') => 0,
            default => 0,
        };
    }

    private function getKompleksitasScore(string $value): int
    {
        return match (true) {
            str_contains($value, 'Prastruktural') => 4,
            str_contains($value, 'Unistruktural') => 3,
            str_contains($value, 'Multistruktural') => 2,
            str_contains($value, 'Relasional') => 1,
            str_contains($value, 'Abstrak Diperluas') => 0,
            default => 0,
        };
    }

    private function getKonteksScore(string $value): int
    {
        return match (true) {
            str_contains($value, 'Dekontekstualisasi') => 2,
            str_contains($value, 'Simulasi') => 1,
            str_contains($value, 'Otentik') => 0,
            default => 0,
        };
    }

    private function getEvaluasiScore(string $value): int
    {
        return match (true) {
            str_contains($value, 'Asesmen Produk') => 2,
            str_contains($value, 'Asesmen Proses') => 1,
            str_contains($value, 'Asesmen Dialogis') => 0,
            default => 0,
        };
    }
}
