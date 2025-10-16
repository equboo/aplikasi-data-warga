<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManajemenController extends Controller
{
    /**
     * Menampilkan halaman gabungan untuk manajemen warga dan keluarga,
     * lengkap dengan data untuk setiap tab.
     */
    public function index(Request $request)
    {
        // --- DATA UNTUK TAB 1: DATA WARGA (lengkap dengan filter & pencarian) ---
        $wargaQuery = Warga::query();

        if ($request->filled('jenis_kelamin') && $request->jenis_kelamin != 'semua') {
            $wargaQuery->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $wargaQuery->where(function($q) use ($searchTerm) {
                $q->where('nama_lengkap', 'like', '%' . $searchTerm . '%')
                  ->orWhere('nik', 'like', '%' . $searchTerm . '%')
                  ->orWhere('nomor_kk', 'like', '%' . $searchTerm . '%')
                  ->orWhere('alamat', 'like', '%' . $searchTerm . '%');
            });
        }
        // Menggunakan nama 'wargaPage' untuk pagination agar tidak bentrok
        $wargas = $wargaQuery->orderBy('nama_lengkap', 'asc')->paginate(15, ['*'], 'wargaPage');

        // --- DATA UNTUK TAB 2: DATA KELUARGA ---
        $kepalaKeluargas = Warga::where('hubungan_keluarga', 'Kepala Keluarga')
                                ->orderBy('kepala_keluarga', 'asc')
                                // Menggunakan nama 'keluargaPage' untuk pagination
                                ->paginate(15, ['*'], 'keluargaPage');

        // Mengirim kedua variabel ($wargas dan $kepalaKeluargas) ke view
        return view('manajemen.index', compact('wargas', 'kepalaKeluargas'));
    }
}