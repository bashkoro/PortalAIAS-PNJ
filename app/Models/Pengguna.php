<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';
    public $timestamps = false;
    protected $guarded = ['id'];

    protected $hidden = [
        'password',
    ];

    public function hakAkses(): BelongsTo
    {
        return $this->belongsTo(HakAkses::class);
    }

    public function programStudi(): BelongsTo
    {
        return $this->belongsTo(ProgramStudi::class);
    }

    public function kelasKuliahDiajar(): HasMany
    {
        return $this->hasMany(KelasKuliah::class, 'dosen_id');
    }

    public function pendaftaranKelas(): HasMany
    {
        return $this->hasMany(PendaftaranKelas::class, 'mahasiswa_id');
    }

    public function kelasKuliah(): BelongsToMany
    {
        return $this->belongsToMany(KelasKuliah::class, 'pendaftaran_kelas', 'mahasiswa_id', 'kelas_kuliah_id');
    }

    public function logAuditAturan(): HasMany
    {
        return $this->hasMany(LogAuditAturan::class, 'admin_id');
    }

    public function deklarasi(): HasMany
    {
        return $this->hasMany(Deklarasi::class, 'mahasiswa_id');
    }

    public function checkRole(string $role): bool
    {
        return $this->hakAkses && strtolower($this->hakAkses->nama_hak_akses) === strtolower($role);
    }
}
