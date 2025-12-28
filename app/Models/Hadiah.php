<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hadiah extends Model
{
    use HasFactory;

    protected $table = 'hadiah';
    protected $fillable = ['nama', 'coin_diperlukan', 'stok', 'gambar'];

    public function penukaran() : HasMany 
    {
        return $this->hasMany(Penukaran::class);
    }
}
