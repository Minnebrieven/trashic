<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Berita extends Model
{
    use HasFactory;
    protected $table = 'berita';
    protected $fillable = [
        'kategori_berita_id',
        'user_id',
        'judul',
        'url',
        'deskripsi',
        'foto'
    ];

    public function kategori_berita(): BelongsTo
    {
        return $this->belongsTo(KategoriBerita::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
