<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();

            // RELASI
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('item_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // DATA SEWA
            $table->date('tanggal_sewa');
            $table->integer('lama_sewa');
            $table->integer('total_harga');

            // STATUS PEMBAYARAN
            $table->enum('payment_status', [
                'pending',
                'paid',
                'rejected'
            ])->default('pending');

            // METODE PEMBAYARAN
            $table->string('payment_method')->nullable();
            $table->string('payment_proof')->nullable();

            // STATUS SEWA
            $table->enum('status_sewa', [
                'belum_diambil',
                'aktif',
                'selesai',
                'dibatalkan'
            ])->default('belum_diambil');

            // TANGGAL PENGEMBALIAN
            $table->date('tanggal_kembali')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
