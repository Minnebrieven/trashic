<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KategoriSampah extends Model
{
    use HasFactory;
    
    protected $table = 'kategori_sampah';
    protected $fillable = ['nama'];

    public function jenis_sampah(): BelongsTo
    {
        return $this->belongsTo(JenisSampah::class);
    }

    public function sampah(): HasMany
    {
        return $this->hasMany(Sampah::class);
    }
}
