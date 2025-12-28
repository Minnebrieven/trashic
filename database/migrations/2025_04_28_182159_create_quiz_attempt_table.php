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
        Schema::create('quiz_attempt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quiz_id')->constrained(
                table: 'quiz', indexName: 'quiz_attempt_pertanyaan_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('rekening_id')->constrained(
                table: 'rekening', indexName: 'quiz_rekening_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status',['belum selesai', 'selesai'])->default('belum selesai');
            $table->integer('score');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_attempt');
    }
};
