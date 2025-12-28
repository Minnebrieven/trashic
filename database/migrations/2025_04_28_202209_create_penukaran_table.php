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
        Schema::create('penukaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekening_id')->constrained(
                table: 'rekening', indexName: 'penukaran_rekening_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('hadiah_id')->constrained(
                table: 'hadiah', indexName: 'penukaran_hadiah_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status', ['belum diterima', 'diterima', 'ditolak'])->default('belum diterima');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penukaran');
    }
};
