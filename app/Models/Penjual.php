<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penjual extends Model
{
    use HasFactory;
    protected $table = 'penjual';
    protected $fillable = ['nama','alamat','telpon'];

    public $timetamps = false;

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class);
    }
}
