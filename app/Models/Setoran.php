<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Setoran extends Model
{
    use HasFactory;
    protected $table = 'setoran';
    protected $fillable = [
        'rekening_id',
        'total_harga'
    ];

    public function rekening(): BelongsTo
    {
        return $this->belongsTo(Rekening::class);
    }

    public function detail_setoran(): HasMany
    {
        return $this->hasMany(DetailSetoran::class);
    }

    public function log_transaksi(): HasMany
    {
        return $this->hasMany(LogTransaksi::class);
    }
}
