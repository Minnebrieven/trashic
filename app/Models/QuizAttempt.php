<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizAttempt extends Model
{
    use HasFactory;
    protected $table = 'quiz_attempt';
    protected $fillable = ['quiz_id', 'rekening_id', 'status', 'score'];

    public function jawaban_quiz(): HasMany
    {
        return $this->hasMany(JawabanQuiz::class);
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function rekening(): BelongsTo
    {
        return $this->belongsTo(Rekening::class);
    }
}
