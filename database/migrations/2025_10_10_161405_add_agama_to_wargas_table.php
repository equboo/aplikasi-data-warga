<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wargas', function (Blueprint $table) {
            // Perintah untuk menambah kolom baru
            $table->string('agama')->after('tanggal_lahir')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('wargas', function (Blueprint $table) {
            // Perintah untuk menghapus kolom jika migrasi di-rollback
            $table->dropColumn('agama');
        });
    }
};