<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jawaban_quiz', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekening_id')->constrained(
                table: 'rekening', indexName: 'jawaban_quiz_rekening_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('quiz_attempt_id')->constrained(
                table: 'quiz_attempt', indexName: 'quiz_attempt_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('pertanyaan_id')->constrained(
                table: 'pertanyaan', indexName: 'jawaban_quiz_pertanyaan_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->enum('jawaban',['A', 'B', 'C', 'D'])->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_quiz');
    }
};
