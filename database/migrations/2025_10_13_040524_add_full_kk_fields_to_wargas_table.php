<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wargas', function (Blueprint $table) {
            // Menambahkan detail alamat lengkap
            $table->string('rt', 3)->nullable()->after('alamat');
            $table->string('rw', 3)->nullable()->after('rt');
            $table->string('desa_kelurahan')->nullable()->after('rw');
            $table->string('kecamatan')->nullable()->after('desa_kelurahan');
            $table->string('kabupaten_kota')->nullable()->after('kecamatan');
            $table->string('kode_pos', 5)->nullable()->after('kabupaten_kota');
            $table->string('provinsi')->nullable()->after('kode_pos');

            // Menambahkan detail data individu
            $table->string('pendidikan')->nullable()->after('agama');
            $table->string('kewarganegaraan')->default('WNI')->after('status_perkawinan');
            $table->string('no_paspor')->nullable()->after('kewarganegaraan');
            $table->string('no_kitas_kitap')->nullable()->after('no_paspor');
        });
    }

    public function down(): void
    {
        Schema::table('wargas', function (Blueprint $table) {
            // Perintah untuk menghapus semua kolom jika migrasi di-rollback
            $table->dropColumn([
                'rt', 'rw', 'desa_kelurahan', 'kecamatan', 'kabupaten_kota', 'kode_pos', 'provinsi',
                'pendidikan', 'kewarganegaraan', 'no_paspor', 'no_kitas_kitap'
            ]);
        });
    }
};