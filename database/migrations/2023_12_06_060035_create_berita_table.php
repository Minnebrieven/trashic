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
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_berita_id')->constrained(
                table: 'kategori_berita', indexName: 'berita_kategori_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->constrained(
                table: 'users', indexName: 'berita_user_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->string('judul');
            $table->string('url')->nullable();
            $table->text('deskripsi');
            $table->string('foto')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
