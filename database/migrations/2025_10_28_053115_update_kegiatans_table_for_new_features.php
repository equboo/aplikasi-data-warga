<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus tabel album foto yang lama
        Schema::dropIfExists('kegiatan_fotos');

        Schema::table('kegiatans', function (Blueprint $table) {
            // Hapus kolom 'foto' yang lama (jika ada)
            if (Schema::hasColumn('kegiatans', 'foto')) {
                $table->dropColumn('foto');
            }

            // Tambahkan kolom-kolom baru
            $table->string('penanggung_jawab')->after('tanggal_kegiatan');
            $table->text('peserta')->nullable()->after('penanggung_jawab');
            $table->decimal('biaya_pengeluaran', 10, 2)->nullable()->after('peserta');
            $table->string('foto_before')->nullable()->after('biaya_pengeluaran');
            $table->string('foto_after')->nullable()->after('foto_before');
        });
    }

    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->string('foto')->nullable();
            $table->dropColumn(['penanggung_jawab', 'peserta', 'biaya_pengeluaran', 'foto_before', 'foto_after']);
        });

        // Buat kembali tabel foto jika di-rollback
        Schema::create('kegiatan_fotos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade');
            $table->string('path');
            $table->timestamps();
        });
    }
};