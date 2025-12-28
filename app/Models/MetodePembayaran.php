<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;
    protected $table = 'metode_pembayaran';
    protected $fillable = [
        'nama'
    ];

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }
}
