<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogTransaksi extends Model
{
    use HasFactory;
    protected $table = 'log_transaksi';
    protected $fillable = [
        'rekening_id',
        'penarikan_id',
        'penarikan_id',
        'status'
    ];

    public function rekening(): BelongsTo
    {
        return $this->belongsTo(Rekening::class);
    }

    public function setoran(): BelongsTo
    {
        return $this->belongsTo(Setoran::class);
    }

    public function penarikan(): BelongsTo
    {
        return $this->belongsTo(Penarikan::class);
    }
}
