<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("
            ALTER TABLE rentals
            MODIFY status_sewa
            ENUM('belum_diambil', 'aktif', 'selesai', 'dibatalkan')
            NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE rentals
            MODIFY status_sewa
            ENUM('aktif', 'selesai', 'dibatalkan')
            NOT NULL
        ");
    }
};
