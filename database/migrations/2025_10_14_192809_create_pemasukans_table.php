<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('pemasukans', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal_pemasukan');
        $table->string('keterangan');
        $table->decimal('jumlah', 10, 2);
        $table->string('bukti')->nullable(); // Kolom untuk path file bukti
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukans');
    }
};
