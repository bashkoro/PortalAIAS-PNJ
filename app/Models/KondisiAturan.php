<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KondisiAturan extends Model
{
    protected $table = 'kondisi_aturan';
    public $timestamps = false;
    protected $guarded = ['id'];

    public function aturan(): BelongsTo
    {
        return $this->belongsTo(Aturan::class);
    }
}
