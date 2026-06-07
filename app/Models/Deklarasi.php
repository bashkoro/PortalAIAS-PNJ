<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Deklarasi extends Model
{
    protected $table = 'deklarasi';
    public $timestamps = false;
    protected $guarded = ['id'];

    protected $casts = [
        'pernyataan_disetujui' => 'boolean',
        'waktu_pengumpulan' => 'datetime',
    ];

    public function tugas(): BelongsTo
    {
        return $this->belongsTo(Tugas::class);
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'mahasiswa_id');
    }

    public function riwayatPrompt(): HasMany
    {
        return $this->hasMany(RiwayatPrompt::class);
    }

    public function tingkatAias(): BelongsTo
    {
        return $this->belongsTo(TingkatAias::class);
    }

    public function validateInput(array $request): bool
    {
        // Add basic validation logic as an example
        if (!isset($request['pernyataan_disetujui']) || !$request['pernyataan_disetujui']) {
            return false;
        }
        return true;
    }

    public function submitDeclaration(array $data): bool
    {
        try {
            $this->fill($data);
            $this->pernyataan_disetujui = true;
            $this->waktu_pengumpulan = now();
            return $this->save();
        } catch (\Exception $e) {
            return false;
        }
    }
}
