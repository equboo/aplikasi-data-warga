<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\RiwayatSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class SuratController extends Controller
{
    /**
     * Menampilkan halaman utama Surat Pengantar (form & riwayat).
     * Route: GET /surat-pengantar
     */
    public function index(Request $request)
    {
        // Data untuk form pembuatan surat
        $wargas = Warga::orderBy('nama_lengkap', 'asc')->get();
        $keperluanList = array_keys($this->getKeperluanOptions());

        // --- Logika untuk Filter Riwayat ---
        $query = RiwayatSurat::with('warga');

        // Terapkan filter bulan jika ada
        if ($request->filled('bulan') && $request->bulan != 'semua') {
            $query->whereMonth('created_at', $request->bulan);
        }

        // Terapkan filter tahun jika ada
        if ($request->filled('tahun') && $request->tahun != 'semua') {
            $query->whereYear('created_at', $request->tahun);
        }

        // Data untuk dropdown filter
        $months = [
            '1' => 'Januari', '2' => 'Februari', '3' => 'Maret', '4' => 'April', 
            '5' => 'Mei', '6' => 'Juni', '7' => 'Juli', '8' => 'Agustus', 
            '9' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];
        // Ambil daftar tahun unik dari riwayat yang ada
        $years = RiwayatSurat::select(DB::raw('YEAR(created_at) as year'))->distinct()->orderBy('year', 'desc')->pluck('year');

        // Ambil data riwayat yang sudah difilter dengan pagination
        $riwayats = $query->latest()->paginate(10)->withQueryString();

        return view('surat.index', compact(
            'wargas', 
            'keperluanList', 
            'riwayats', 
            'months', 
            'years'
        ));
    }

    /**
     * Menghasilkan PDF surat pengantar dan menyimpan riwayat.
     * Route: POST /surat-pengantar/cetak
     */
    public function generate(Request $request)
    {
        $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'keperluan' => 'required|string|max:255',
        ]);

        $warga = Warga::findOrFail($request->warga_id);
        
        $nomorSurat = $this->generateNomorSurat();

        RiwayatSurat::create([
            'nomor_surat' => $nomorSurat,
            'warga_id' => $warga->id,
            'keperluan' => $request->keperluan,
        ]);

        // Ambil daftar persyaratan berdasarkan keperluan yang dipilih
        $persyaratan = $this->getKeperluanOptions()[$request->keperluan] ?? [];

        $data = [
            'warga' => $warga,
            'keperluan' => $request->keperluan,
            'nomor_surat' => $nomorSurat,
            'persyaratan' => $persyaratan,
            'ketua_rt' => 'Andi Nugroho', // Ganti dengan nama ketua RT
            'tanggal_surat' => now()->translatedFormat('d F Y'),
        ];

        $pdf = PDF::loadView('warga.surat_pengantar_pdf', $data);
        return $pdf->stream('surat-pengantar-' . $warga->nik . '.pdf');
    }

    /**
     * Menghapus data riwayat surat.
     * Route: DELETE /surat-pengantar/{riwayat_surat}
     */
    public function destroy(RiwayatSurat $riwayat_surat)
    {
        $riwayat_surat->delete();
        return redirect()->route('surat.index')
                         ->with('success', 'Riwayat surat berhasil dihapus.');
    }

    /**
     * Helper function untuk menyediakan daftar keperluan surat dan persyaratannya.
     */
    private function getKeperluanOptions(): array
    {
        return [
            'PENGURUSAN AKTE KELAHIRAN' => [
                'Surat Keterangan Lahir dari Bidan/Rumah Sakit (Asli)',
                'Fotocopy Kartu Keluarga (KK)',
                'Fotocopy KTP Ayah dan Ibu',
                'Fotocopy Surat Nikah / Akta Perkawinan Orang Tua',
                'Nama dua orang saksi',
            ],
            'PENGURUSAN KARTU TANDA PENDUDUK (KTP)' => [
                'Fotocopy Kartu Keluarga (KK)',
                'Fotocopy Akte Kelahiran / Ijazah Terakhir',
                'Surat Keterangan Pindah (jika pendatang)',
            ],
            'PENGURUSAN SURAT KETERANGAN CATATAN KEPOLISIAN (SKCK)' => [
                'Fotocopy Kartu Tanda Penduduk (KTP)',
                'Fotocopy Kartu Keluarga (KK)',
                'Fotocopy Akte Kelahiran',
                'Pas Foto ukuran 4x6 latar merah (6 lembar)',
            ],
            'SURAT KETERANGAN DOMISILI' => [],
            'SURAT KETERANGAN TIDAK MAMPU (SKTM)' => [
                'Fotocopy Kartu Tanda Penduduk (KTP)',
                'Fotocopy Kartu Keluarga (KK)',
            ],
        ];
    }

    /**
     * Helper function untuk membuat nomor surat otomatis.
     */
    private function generateNomorSurat(): string
    {
        $bulanRomawi = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $bulan = $bulanRomawi[date('n') - 1];
        $tahun = date('Y');

        // Ambil nomor urut terakhir di tahun ini
        $lastRecord = RiwayatSurat::whereYear('created_at', $tahun)->latest('id')->first();
        $nomorUrut = $lastRecord ? (int)substr($lastRecord->nomor_surat, 0, 3) + 1 : 1;

        return sprintf('%03d', $nomorUrut) . '/SP/RT06/' . $bulan . '/' . $tahun;
    }
}