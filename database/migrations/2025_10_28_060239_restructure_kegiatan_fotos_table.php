<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Membersihkan tabel 'kegiatans' dari kolom foto yang lama (jika ada)
        Schema::table('kegiatans', function (Blueprint $table) {
            if (Schema::hasColumn('kegiatans', 'foto')) {
                $table->dropColumn('foto');
            }
            if (Schema::hasColumn('kegiatans', 'foto_before')) {
                $table->dropColumn('foto_before');
            }
            if (Schema::hasColumn('kegiatans', 'foto_after')) {
                $table->dropColumn('foto_after');
            }
        });

        // 2. Hapus tabel 'kegiatan_fotos' yang lama (jika ada) agar kita bisa membuatnya ulang dengan benar
        Schema::dropIfExists('kegiatan_fotos');

        // 3. Buat tabel 'kegiatan_fotos' yang baru dengan kolom 'type'
        Schema::create('kegiatan_fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade');
            $table->string('path'); // Path ke file foto
            $table->enum('type', ['before', 'after']); // Kolom untuk membedakan before/after
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kegiatan_fotos');
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->string('foto_before')->nullable();
            $table->string('foto_after')->nullable();
        });
    }
};