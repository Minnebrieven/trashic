<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class DetailSetoran extends Model
{
    use HasFactory;
    protected $table = 'detail_setoran';
    protected $fillable = [
        'setoran_id',
        'sampah_id',
        'jumlah'
    ];

    public function setoran(): BelongsTo
    {
        return $this->belongsTo(Setoran::class);
    }

    public function sampah(): BelongsTo
    {
        return $this->belongsTo(Sampah::class);
    }
}

