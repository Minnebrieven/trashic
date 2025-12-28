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
        Schema::create('detail_setoran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('setoran_id')->constrained(
                table: 'setoran', indexName: 'setoran_detail_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('sampah_id')->constrained(
                table: 'sampah', indexName: 'detail_setoran_sampah_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->integer('jumlah');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_setoran');
    }
};
