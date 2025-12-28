<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class JenisSampah extends Model
{
    use HasFactory;
    protected $table = 'jenis_sampah';
    protected $fillable = ['jenis_Sampah'];

    public function sampah(): HasMany
    {
        return $this->hasMany(Sampah::class);
    }
}
