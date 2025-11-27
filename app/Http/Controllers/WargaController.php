<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use PDF;

class WargaController extends Controller
{
    /**
     * NOTE: Method index() sudah tidak digunakan karena digantikan oleh ManajemenController.
     */
    public function index(Request $request)
    {
        // Redirect ke halaman manajemen baru
        return redirect()->route('manajemen.index');
    }

    /**
     * Menampilkan form untuk mengedit data warga.
     */
    public function edit(Warga $warga)
    {
        return view('warga.edit', compact('warga'));
    }

    /**
     * Memperbarui data yang ada di database.
     */
    public function update(Request $request, Warga $warga)
    {
        $request->validate([
            'nomor_kk' => 'required|digits:16',
            'kepala_keluarga' => 'required|string|max:255',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'desa_kelurahan' => 'required|string',
            'kecamatan' => 'required|string',
            'kabupaten_kota' => 'required|string',
            'kode_pos' => 'required|string|max:5',
            'provinsi' => 'required|string',
            'status_rumah' => 'required|string',
            'nik' => 'required|digits:16|unique:wargas,nik,' . $warga->id,
            'nama_lengkap' => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'hubungan_keluarga' => 'required|string|max:100',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'agama' => 'required|string',
            'pendidikan' => 'required|string',
            'pekerjaan' => 'required|string|max:100',
            'status_perkawinan' => 'required',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
        ]);

        // 1. Update data individu yang sedang diedit
        $warga->update($request->all());

        // 2. SINKRONISASI: Update data tingkat keluarga untuk semua anggota lain
        Warga::where('nomor_kk', $request->nomor_kk)
             ->where('id', '!=', $warga->id) // Hindari mengupdate diri sendiri lagi
             ->update([
                 'kepala_keluarga' => $request->kepala_keluarga,
                 'alamat' => $request->alamat,
                 'rt' => $request->rt,
                 'rw' => $request->rw,
                 'desa_kelurahan' => $request->desa_kelurahan,
                 'kecamatan' => $request->kecamatan,
                 'kabupaten_kota' => $request->kabupaten_kota,
                 'kode_pos' => $request->kode_pos,
                 'provinsi' => $request->provinsi,
                 'status_rumah' => $request->status_rumah,
             ]);

        return redirect()->route('manajemen.index')->with('success', 'Data warga berhasil diperbarui.');
    }

    /**
     * Menghapus data dari database.
     */
    public function destroy(Warga $warga)
    {
        $warga->delete();
        
        return redirect()->route('manajemen.index')->with('success', 'Data warga berhasil dihapus.');
    }

    /**
     * Membuat dan mengunduh file PDF berisi data warga sesuai filter.
     */
    public function downloadPDF(Request $request)
    {
        $query = Warga::query();

        // Filter Jenis Kelamin
        if ($request->filled('jenis_kelamin') && $request->jenis_kelamin != 'semua') {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        // Filter Pencarian
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('nama_lengkap', 'like', '%' . $searchTerm . '%')
                  ->orWhere('nik', 'like', '%' . $searchTerm . '%')
                  ->orWhere('nomor_kk', 'like', '%' . $searchTerm . '%')
                  ->orWhere('alamat', 'like', '%' . $searchTerm . '%');
            });
        }

        // ===== LOGIKA FILTER USIA BARU DITAMBAHKAN DI SINI =====
        if ($request->filled('age_group') && $request->age_group != 'semua') {
            $age_group = $request->age_group;
            
            if ($age_group == '0-5') {
                $query->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 5');
            } elseif ($age_group == '6-12') {
                $query->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 6 AND 12');
            } elseif ($age_group == '13-19') {
                $query->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 13 AND 19');
            } elseif ($age_group == '20-59') {
                $query->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 20 AND 59');
            } elseif ($age_group == '60+') {
                $query->whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60');
            }
        }
        // ===== AKHIR LOGIKA FILTER USIA =====

        $wargas = $query->orderBy('nama_lengkap', 'asc')->get();
        $data = [
            'title' => 'Daftar Warga RT.06/RW.07',
            'date' => date('d/m/Y'),
            'wargas' => $wargas
        ];

        $pdf = PDF::loadView('warga.pdf', $data)->setPaper('a4', 'portrait');

        return $pdf->stream('daftar-warga-rt06-rw07.pdf');
    }
}