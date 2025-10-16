<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IplController;
use App\Http\Controllers\ManajemenController;
use App\Http\Controllers\KegiatanController; 
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Halaman Manajemen Gabungan
    Route::get('/manajemen', [ManajemenController::class, 'index'])->name('manajemen.index');

    // Surat Pengantar
    Route::get('/surat-pengantar', [SuratController::class, 'index'])->name('surat.index');
    Route::post('/surat-pengantar/cetak', [SuratController::class, 'generate'])->name('surat.generate');
    Route::delete('/surat-pengantar/{riwayat_surat}', [SuratController::class, 'destroy'])->name('surat.destroy');

    // Data Warga (Hanya untuk aksi Edit, Update, Hapus, Cetak)
    Route::get('/warga/download/pdf', [WargaController::class, 'downloadPDF'])->name('warga.download.pdf');
    Route::resource('warga', WargaController::class)->except(['index', 'create', 'store']);

    // Data Keluarga (Hanya untuk aksi detail, hapus, cetak, dll)
    Route::get('/keluarga/{keluarga}/cetak', [KeluargaController::class, 'cetakKK'])->name('keluarga.cetak');
    Route::post('/keluarga/{keluarga}/add-member', [KeluargaController::class, 'addMember'])->name('keluarga.addMember');
    Route::post('/keluarga', [KeluargaController::class, 'store'])->name('keluarga.store'); // Tetap butuh 'store' untuk form
    Route::resource('keluarga', KeluargaController::class)->except(['index', 'create']);

    // Manajemen IPL
    Route::get('/ipl', [IplController::class, 'index'])->name('ipl.index');
    Route::post('/ipl/generate-tagihan', [IplController::class, 'generateTagihan'])->name('ipl.generate');
    Route::patch('/ipl/{iuran}/bayar', [IplController::class, 'tandaiLunas'])->name('ipl.bayar');
    Route::patch('/ipl/{iuran}/batalkan', [IplController::class, 'batalkanLunas'])->name('ipl.batalkan');
    Route::get('/ipl/cetak', [IplController::class, 'cetakIpl'])->name('ipl.cetak');

    Route::post('/laporan/pemasukan', [IplController::class, 'storePemasukan'])->name('pemasukan.store');
    Route::delete('/laporan/pemasukan/{pemasukan}', [IplController::class, 'destroyPemasukan'])->name('pemasukan.destroy');
    Route::post('/laporan/pengeluaran', [IplController::class, 'storePengeluaran'])->name('pengeluaran.store');
    Route::delete('/laporan/pengeluaran/{pengeluaran}', [IplController::class, 'destroyPengeluaran'])->name('pengeluaran.destroy');
    Route::get('/laporan/cetak', [IplController::class, 'cetakLaporan'])->name('laporan.cetak');

    // RUTE UNTUK JURNAL KEGIATAN
    Route::resource('/kegiatan', KegiatanController::class)->except([ 'edit', 'update']);
});

require __DIR__.'/auth.php';