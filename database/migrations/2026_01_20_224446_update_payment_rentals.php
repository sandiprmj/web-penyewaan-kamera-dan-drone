<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rentals', function (Blueprint $table) {

            if (!Schema::hasColumn('rentals', 'payment_method')) {
                $table->enum('payment_method', ['qris','cash'])
                      ->after('total_harga');
            }

            if (!Schema::hasColumn('rentals', 'payment_status')) {
                $table->enum('payment_status', ['pending','belum_bayar','lunas'])
                      ->default('pending');
            }

            if (!Schema::hasColumn('rentals', 'payment_proof')) {
                $table->string('payment_proof')->nullable();
            }

        });
    }

    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {

            if (Schema::hasColumn('rentals', 'payment_method')) {
                $table->dropColumn('payment_method');
            }

            if (Schema::hasColumn('rentals', 'payment_status')) {
                $table->dropColumn('payment_status');
            }

            if (Schema::hasColumn('rentals', 'payment_proof')) {
                $table->dropColumn('payment_proof');
            }

        });
    }
};
