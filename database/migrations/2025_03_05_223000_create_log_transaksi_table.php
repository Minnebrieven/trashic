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
        Schema::create('log_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekening_id')->constrained(
                table: 'rekening', indexName: 'rekening_log_transaksi_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('setoran_id')->nullable()->constrained(
                table: 'setoran', indexName: 'setoran_log_transaksi_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('penarikan_id')->nullable()->constrained(
                table: 'penarikan', indexName: 'penarikan_log_transaksi_id'
            )->onUpdate('cascade')->onDelete('cascade');
            $table->enum('status',['belum diterima', 'diterima', 'ditolak'])->default('belum diterima');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_transaksi');
    }
};
