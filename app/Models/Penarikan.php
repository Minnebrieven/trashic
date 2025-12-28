<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penarikan extends Model
{
    use HasFactory;
    protected $table = 'Penarikan';
    protected $fillable = [
        'rekening_id',
        'total_harga',
        'metode_pembayaran_id'
    ];

    public function rekening(): BelongsTo
    {
        return $this->belongsTo(Rekening::class);
    }

    public function metode_pembayaran(): BelongsTo
    {
        return $this->belongsTo(MetodePembayaran::class);
    }

    public function log_transaksi(): HasMany
    {
        return $this->hasMany(LogTransaksi::class);
    }
}
