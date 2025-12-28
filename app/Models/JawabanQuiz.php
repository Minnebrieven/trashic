<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JawabanQuiz extends Model
{
    use HasFactory;

    protected $table = 'jawaban_quiz';
    protected $fillable = ['rekening_id', 'quiz_attempt_id', 'pertanyaan_id', 'status'];

    public function rekening(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function quiz_attempt() : BelongsTo 
    {
        return $this->belongsTo(QuizAttempt::class);
    }

    public function pertanyaan() : BelongsTo 
    {
        return $this->belongsTo(Pertanyaan::class);
    }
}
