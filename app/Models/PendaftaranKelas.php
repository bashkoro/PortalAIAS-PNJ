<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PendaftaranKelas extends Model
{
    protected $table = 'pendaftaran_kelas';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function kelasKuliah(): BelongsTo
    {
        return $this->belongsTo(KelasKuliah::class);
    }

    public function mahasiswa(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'mahasiswa_id');
    }
}
