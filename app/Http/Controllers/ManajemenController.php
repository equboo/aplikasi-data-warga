<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ManajemenController extends Controller
{
    public function index(Request $request)
    {
        // --- DATA UNTUK TAB 1: DATA WARGA ---
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
        if ($request->filled('age_group') && $request->age_group != 'semua') {
            $age_group = $request->age_group;
            if ($age_group == '0-5') { $wargaQuery->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 5'); }
            elseif ($age_group == '6-12') { $wargaQuery->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 6 AND 12'); }
            elseif ($age_group == '13-19') { $wargaQuery->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 13 AND 19'); }
            elseif ($age_group == '20-59') { $wargaQuery->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 20 AND 59'); }
            elseif ($age_group == '60+') { $wargaQuery->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60'); }
        }
        $wargas = $wargaQuery->orderBy('nama_lengkap', 'asc')->paginate(15, ['*'], 'wargaPage');

        // --- DATA UNTUK TAB 2: DATA KELUARGA ---
        $kepalaKeluargaQuery = Warga::where('hubungan_keluarga', 'Kepala Keluarga');

        // ===== LOGIKA PENCARIAN KELUARGA BARU =====
        if ($request->filled('search_keluarga')) {
            $searchTermKeluarga = $request->search_keluarga;
            $kepalaKeluargaQuery->where(function($q) use ($searchTermKeluarga) {
                $q->where('kepala_keluarga', 'like', '%' . $searchTermKeluarga . '%')
                  ->orWhere('nomor_kk', 'like', '%' . $searchTermKeluarga . '%')
                  ->orWhere('alamat', 'like', '%' . $searchTermKeluarga . '%');
            });
        }
        // ===== AKHIR LOGIKA PENCARIAN =====
        
        $kepalaKeluargas = $kepalaKeluargaQuery->orderBy('kepala_keluarga', 'asc')
                                ->paginate(15, ['*'], 'keluargaPage');

        return view('manajemen.index', compact('wargas', 'kepalaKeluargas'));
    }

    public function cetakDataKeluarga(Request $request)
    {
        // --- LOGIKA QUERY UNTUK TAB KELUARGA (DISALIN DARI INDEX) ---
        $kepalaKeluargaQuery = Warga::where('hubungan_keluarga', 'Kepala Keluarga');

        // Terapkan filter pencarian jika ada
        if ($request->filled('search_keluarga')) {
            $searchTermKeluarga = $request->search_keluarga;
            $kepalaKeluargaQuery->where(function($q) use ($searchTermKeluarga) {
                $q->where('kepala_keluarga', 'like', '%' . $searchTermKeluarga . '%')
                  ->orWhere('nomor_kk', 'like', '%' . $searchTermKeluarga . '%')
                  ->orWhere('alamat', 'like', '%' . $searchTermKeluarga . '%');
            });
        }
        
        // Ambil semua data (tanpa pagination) untuk PDF
        $kepalaKeluargas = $kepalaKeluargaQuery->orderBy('kepala_keluarga', 'asc')->get();

        $data = [
            'title' => 'Daftar Kepala Keluarga RT.06/RW.07',
            'date' => now()->translatedFormat('d F Y'),
            'kepalaKeluargas' => $kepalaKeluargas,
        ];

        // Muat view PDF dengan data
        $pdf = PDF::loadView('keluarga.pdf_list', $data)->setPaper('a4', 'portrait');

        return $pdf->stream('daftar-kepala-keluarga.pdf');
    }
}