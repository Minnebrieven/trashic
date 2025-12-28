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
        Schema::create('sampah', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->foreignId('kategori_sampah_id')->constrained(
                table: 'kategori_sampah', indexName: 'sampah_kategori_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->string('satuan');
            $table->double('harga', 8, 3);
            $table->integer('score')->nullable();
            $table->integer('coin')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sampah');
    }
};
