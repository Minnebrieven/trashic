<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rekening extends Model
{
    use HasFactory;
    protected $table = 'Rekening';
    protected $fillable = [
        'user_id',
        'nomor_rekening',
        'saldo'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setoran(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function penarikan(): HasMany
    {
        return $this->hasMany(Penarikan::class);
    }

    public function log_transaksi(): HasMany
    {
        return $this->hasMany(LogTransaksi::class);
    }
}
