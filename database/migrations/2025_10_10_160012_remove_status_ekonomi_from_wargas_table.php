<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wargas', function (Blueprint $table) {
            // Perintah untuk menghapus kolom
            $table->dropColumn('status_ekonomi');
        });
    }

    public function down(): void
    {
        Schema::table('wargas', function (Blueprint $table) {
            // Perintah untuk mengembalikan kolom jika migrasi di-rollback
            $table->enum('status_ekonomi', ['Mampu', 'Menengah', 'Kurang Mampu'])->default('Menengah');
        });
    }
};