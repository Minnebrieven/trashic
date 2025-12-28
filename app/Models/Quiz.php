<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quiz';
    protected $fillable = ['judul', 'score_per_pertanyaan', 'coin_per_pertanyaan'];

    public function pertanyaan(): HasMany
    {
        return $this->hasMany(Pertanyaan::class);
    }
}
