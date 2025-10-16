<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wargas', function (Blueprint $table) {
            // Menambahkan dua kolom baru setelah kolom 'pekerjaan'
            $table->string('nama_ayah')->nullable()->after('pekerjaan');
            $table->string('nama_ibu')->nullable()->after('nama_ayah');
        });
    }

    public function down(): void
    {
        Schema::table('wargas', function (Blueprint $table) {
            // Perintah untuk menghapus kolom jika migrasi di-rollback
            $table->dropColumn(['nama_ayah', 'nama_ibu']);
        });
    }
};