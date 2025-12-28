<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penukaran extends Model
{
    use HasFactory;

    protected $table = 'penukaran';
    protected $fillable = ['rekening_id', 'hadiah_id'];

    public function rekening(): BelongsTo
    {
        return $this->belongsTo(Rekening::class);
    }

    public function hadiah(): BelongsTo
    {
        return $this->belongsTo(Hadiah::class);
    }
}
