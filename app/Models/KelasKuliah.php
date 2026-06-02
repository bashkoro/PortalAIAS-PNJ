<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class KelasKuliah extends Model
{
    protected $table = 'kelas_kuliah';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function mataKuliah(): BelongsTo
    {
        return $this->belongsTo(MataKuliah::class);
    }

    public function periodeAkademik(): BelongsTo
    {
        return $this->belongsTo(PeriodeAkademik::class);
    }

    public function dosen(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'dosen_id');
    }

    public function pendaftaranKelas(): HasMany
    {
        return $this->hasMany(PendaftaranKelas::class);
    }

    public function mahasiswa(): BelongsToMany
    {
        return $this->belongsToMany(Pengguna::class, 'pendaftaran_kelas', 'kelas_kuliah_id', 'mahasiswa_id');
    }

    public function tugas(): HasMany
    {
        return $this->hasMany(Tugas::class);
    }
}
