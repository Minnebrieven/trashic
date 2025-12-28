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
        Schema::create('penarikan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekening_id')->constrained(
                table: 'rekening', indexName: 'rekening_penarikan_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->double('total_harga', 8, 2);
            $table->foreignId('metode_pembayaran_id')->constrained(
                table: 'metode_pembayaran', indexName: 'metode_pembayaran_penarikan_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penarikan');
    }
};
