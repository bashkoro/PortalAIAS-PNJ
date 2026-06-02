<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tugas extends Model
{
    protected $table = 'tugas';
    public $timestamps = false;
    protected $guarded = ['id'];

    protected $casts = [
        'kriteria_tugas' => 'array',
    ];

    public function kelasKuliah(): BelongsTo
    {
        return $this->belongsTo(KelasKuliah::class);
    }

    public function tingkatAiasAkhir(): BelongsTo
    {
        return $this->belongsTo(TingkatAias::class, 'tingkat_aias_akhir_id');
    }

    public function deklarasi(): HasMany
    {
        return $this->hasMany(Deklarasi::class);
    }

    public function calculateAIScore(array $kriteria): ?int
    {
        $activeRules = Aturan::getActiveRules();

        foreach ($activeRules as $rule) {
            $isMatch = true;

            foreach ($rule->kondisiAturan as $kondisi) {
                $paramName = $kondisi->nama_parameter;
                $targetValue = $kondisi->target_value;

                // Check if the input criteria has the parameter and matches the target value
                if (!isset($kriteria[$paramName]) || $kriteria[$paramName] !== $targetValue) {
                    $isMatch = false;
                    break; // Move to the next rule
                }
            }

            if ($isMatch) {
                // If all conditions for a rule match, return its tingkat_aias_id
                return $rule->tingkat_aias_id;
            }
        }

        // No matching rule found
        return null;
    }

    public function saveAsDraft(): bool
    {
        $this->status_publikasi = 'Draft';
        return $this->save();
    }

    public function publishTask(): bool
    {
        $this->status_publikasi = 'Published';
        return $this->save();
    }
}
