<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogAuditAturan extends Model
{
    protected $table = 'log_audit_aturan';
    public $timestamps = false;
    protected $guarded = ['id'];

    protected $casts = [
        'nilai_lama' => 'array',
        'nilai_baru' => 'array',
        'waktu_aksi' => 'datetime',
    ];

    public function aturan(): BelongsTo
    {
        return $this->belongsTo(Aturan::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class, 'admin_id');
    }
}
