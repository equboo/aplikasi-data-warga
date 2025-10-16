<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            // Data Keluarga
            $table->string('nomor_kk', 20);
            $table->string('kepala_keluarga');
            $table->text('alamat');

            // Data Individu
            $table->string('nik', 20)->unique();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('hubungan_keluarga'); // Cth: Kepala Keluarga, Istri, Anak
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            // Klasifikasi Data
            $table->enum('status_perkawinan', ['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati']);
            $table->enum('status_ekonomi', ['Mampu', 'Menengah', 'Kurang Mampu'])->default('Menengah');
            $table->string('pekerjaan');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wargas');
    }
};