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
        Schema::create('setoran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekening_id')->constrained(
                table: 'rekening', indexName: 'rekening_setoran_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->double('total_harga', 8, 2);
            $table->integer('total_score')->nullable();
            $table->integer('total_coin')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setoran');
    }
};
