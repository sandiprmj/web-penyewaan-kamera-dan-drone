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
                $table->enum('payment_method', ['transfer','cash'])
                      ->nullable()
                      ->after('total_harga');
            }

            if (!Schema::hasColumn('rentals', 'payment_proof')) {
                $table->string('payment_proof')->nullable();
            }

            if (!Schema::hasColumn('rentals', 'payment_status')) {
                $table->enum('payment_status', ['pending','confirmed','rejected'])
                      ->default('pending');
            }

        });
    }

    public function down(): void
    {
        Schema::table('rentals', function (Blueprint $table) {

            if (Schema::hasColumn('rentals', 'payment_method')) {
                $table->dropColumn('payment_method');
            }

            if (Schema::hasColumn('rentals', 'payment_proof')) {
                $table->dropColumn('payment_proof');
            }

            if (Schema::hasColumn('rentals', 'payment_status')) {
                $table->dropColumn('payment_status');
            }

        });
    }
};
