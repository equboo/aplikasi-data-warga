<?php

namespace App\Http\Controllers;

use App\Models\Iuran;
use App\Models\Pemasukan; // Menggunakan model Pemasukan
use App\Models\Pengeluaran;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;

class IplController extends Controller
{
    /**
     * Menampilkan halaman utama status iuran dengan filter.
     */
      public function index(Request $request)
    {
        // --- DATA UNTUK TAB 1: STATUS PEMBAYARAN ---
        $bulan_status = (int)$request->input('bulan_status', now()->month);
        $tahun_status = (int)$request->input('tahun_status', now()->year);
        $search_status = $request->input('search_status');
        $status_pembayaran = $request->input('status_pembayaran');

        $tagihanSudahAda = Iuran::where('bulan', $bulan_status)->where('tahun', $tahun_status)->exists();
        
        $query = Warga::where('hubungan_keluarga', 'Kepala Keluarga');
        if ($search_status) {
            $query->where('nama_lengkap', 'like', '%' . $search_status . '%');
        }
        if ($tagihanSudahAda && $status_pembayaran && $status_pembayaran != 'semua') {
            if ($status_pembayaran == 'Lunas') {
                $query->whereHas('iurans', function ($q) use ($bulan_status, $tahun_status) {
                    $q->where('bulan', $bulan_status)->where('tahun', $tahun_status)->where('status', 'Lunas');
                });
            } elseif ($status_pembayaran == 'Belum Lunas') {
                $query->whereDoesntHave('iurans', function ($sub) use ($bulan_status, $tahun_status) {
                    $sub->where('bulan', $bulan_status)->where('tahun', $tahun_status)->where('status', 'Lunas');
                });
            }
        }
        $kepalaKeluargas = $query->orderBy('nama_lengkap')->get();

        $iurans = Iuran::with('warga')->where('bulan', $bulan_status)->where('tahun', $tahun_status)->get()->keyBy('warga_id');
        $totalLunas = Iuran::where('bulan', $bulan_status)->where('tahun', $tahun_status)->where('status', 'Lunas')->count();
        $totalKeluarga = Warga::where('hubungan_keluarga', 'Kepala Keluarga')->count();
        $totalBelumLunas = $totalKeluarga - $totalLunas;
        
        // --- DATA UNTUK TAB 2: LAPORAN ARUS KAS ---
        $bulan_laporan = (int)$request->input('bulan_laporan', now()->month);
        $tahun_laporan = (int)$request->input('tahun_laporan', now()->year);

        $pemasukanIuran = Iuran::where('status', 'Lunas')->whereMonth('tanggal_bayar', $bulan_laporan)->whereYear('tanggal_bayar', $tahun_laporan)->sum('jumlah_tagihan');
        $pemasukanLainQuery = Pemasukan::whereMonth('tanggal_pemasukan', $bulan_laporan)->whereYear('tanggal_pemasukan', $tahun_laporan);
        $totalPemasukanLain = $pemasukanLainQuery->sum('jumlah');
        $pemasukans = $pemasukanLainQuery->latest('tanggal_pemasukan')->get();
        $totalPemasukan = $pemasukanIuran + $totalPemasukanLain;

        $pengeluaranQuery = Pengeluaran::whereMonth('tanggal_pengeluaran', $bulan_laporan)->whereYear('tanggal_pengeluaran', $tahun_laporan);
        $totalPengeluaran = $pengeluaranQuery->sum('jumlah');
        $pengeluarans = $pengeluaranQuery->latest('tanggal_pengeluaran')->get();
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Data Umum
        $months = $this->getMonths();
        $years = Iuran::select(DB::raw('YEAR(created_at) as year'))->distinct()->orderBy('year', 'desc')->pluck('year');

        return view('ipl.index', compact(
            'kepalaKeluargas', 'iurans', 'tagihanSudahAda', 'totalLunas', 'totalBelumLunas', 
            'bulan_status', 'tahun_status',
            'totalPemasukan', 'pemasukanIuran', 'pemasukans', 'pengeluarans', 'totalPengeluaran', 
            'saldo', 'bulan_laporan', 'tahun_laporan',
            'months', 'years'
        ));
    }
    /**
     * Mencetak Laporan Status Iuran dalam format PDF.
     */
    public function cetakIpl(Request $request)
    {
        $bulan = (int)$request->input('bulan', now()->month);
        $tahun = (int)$request->input('tahun', now()->year);
        $search = $request->input('search');
        $status = $request->input('status');

        $query = Warga::where('hubungan_keluarga', 'Kepala Keluarga');

        if ($search) {
            $query->where('nama_lengkap', 'like', '%' . $search . '%');
        }

        if ($status && $status != 'semua') {
            if ($status == 'Lunas') {
                $query->whereHas('iurans', function ($q) use ($bulan, $tahun) {
                    $q->where('bulan', $bulan)->where('tahun', $tahun)->where('status', 'Lunas');
                });
            } elseif ($status == 'Belum Lunas') {
                $query->whereDoesntHave('iurans', function ($sub) use ($bulan, $tahun) {
                    $sub->where('bulan', $bulan)->where('tahun', $tahun)->where('status', 'Lunas');
                });
            }
        }
        
        $kepalaKeluargas = $query->orderBy('nama_lengkap')->get();

        $iurans = Iuran::where('bulan', $bulan)
            ->where('tahun', $tahun)
            ->get()->keyBy('warga_id');

        $data = [
            'kepalaKeluargas' => $kepalaKeluargas,
            'iurans' => $iurans,
            'periode' => \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') . ' ' . $tahun,
            'tanggal_cetak' => now()->translatedFormat('d F Y'),
        ];

        $pdf = PDF::loadView('ipl.ipl_pdf', $data);
        return $pdf->stream('laporan-ipl-' . $bulan . '-' . $tahun . '.pdf');
    }
    /**
     * Membuat tagihan iuran bulanan.
     */
    public function generateTagihan(Request $request)
    {
        $bulan = (int)$request->input('bulan', now()->month);
        $tahun = (int)$request->input('tahun', now()->year);
        $jumlahTagihan = 100000;

        if (Iuran::where('bulan', $bulan)->where('tahun', $tahun)->exists()) {
            return redirect()->route('ipl.index', ['bulan' => $bulan, 'tahun' => $tahun])->with('error', 'Tagihan untuk periode ini sudah pernah dibuat.');
        }

        $kepalaKeluargas = Warga::where('hubungan_keluarga', 'Kepala Keluarga')->get();
        foreach ($kepalaKeluargas as $keluarga) {
            Iuran::create([
                'warga_id' => $keluarga->id, 'bulan' => $bulan, 'tahun' => $tahun, 'jumlah_tagihan' => $jumlahTagihan,
            ]);
        }
        return redirect()->route('ipl.index', ['bulan' => $bulan, 'tahun' => $tahun])->with('success', 'Tagihan iuran berhasil dibuat untuk semua keluarga.');
    }

    /**
     * Menandai iuran sebagai 'Lunas'.
     */
    public function tandaiLunas(Iuran $iuran)
    {
        $iuran->update(['status' => 'Lunas', 'tanggal_bayar' => now()]);
        return redirect()->back()->with('success', 'Pembayaran berhasil dicatat.');
    }

    /**
     * Membatalkan status lunas.
     */
    public function batalkanLunas(Iuran $iuran)
    {
        $iuran->update(['status' => 'Belum Lunas', 'tanggal_bayar' => null]);
        return redirect()->back()->with('success', 'Status pembayaran berhasil dibatalkan.');
    }

    /**
     * Menampilkan halaman laporan keuangan.
     */
    public function laporan(Request $request)
    {
        $bulan = (int)$request->input('bulan', now()->month);
        $tahun = (int)$request->input('tahun', now()->year);

        // Pemasukan dari Iuran Rutin
        $pemasukanIuran = Iuran::where('status', 'Lunas')->whereMonth('tanggal_bayar', $bulan)->whereYear('tanggal_bayar', $tahun)->sum('jumlah_tagihan');
        
        // Pemasukan Lainnya
        $pemasukanLainQuery = Pemasukan::whereMonth('tanggal_pemasukan', $bulan)->whereYear('tanggal_pemasukan', $tahun);
        $totalPemasukanLain = $pemasukanLainQuery->sum('jumlah');
        $pemasukans = $pemasukanLainQuery->latest('tanggal_pemasukan')->get();
        $totalPemasukan = $pemasukanIuran + $totalPemasukanLain;

        // Pengeluaran
        $pengeluaranQuery = Pengeluaran::whereMonth('tanggal_pengeluaran', $bulan)->whereYear('tanggal_pengeluaran', $tahun);
        $totalPengeluaran = $pengeluaranQuery->sum('jumlah');
        $pengeluarans = $pengeluaranQuery->latest('tanggal_pengeluaran')->get();
        
        $saldo = $totalPemasukan - $totalPengeluaran;
        
        $months = $this->getMonths();
        $years = Iuran::select(DB::raw('YEAR(created_at) as year'))->distinct()
            ->union(Pengeluaran::select(DB::raw('YEAR(tanggal_pengeluaran) as year'))->distinct())
            ->union(Pemasukan::select(DB::raw('YEAR(tanggal_pemasukan) as year'))->distinct())
            ->orderBy('year', 'desc')->pluck('year');

        return view('ipl.laporan', compact(
            'totalPemasukan', 'pemasukans', 'pengeluarans', 'pemasukanIuran', 'totalPengeluaran', 
            'saldo', 'months', 'years', 'bulan', 'tahun'
        ));
    }

    /**
     * Menyimpan data pemasukan baru.
     */
   public function storePemasukan(Request $request)
    {
        $request->validate([
            'tanggal_pemasukan' => 'required|date',
            'keterangan' => 'required|string',
            'jumlah' => 'required|numeric|min:0',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti_pemasukan', 'public');
        }

        Pemasukan::create([
            'tanggal_pemasukan' => $request->tanggal_pemasukan,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah,
            'bukti' => $path,
        ]);

        // PERBAIKAN: Redirect ke halaman utama IPL dan buka tab laporan
        return redirect()->route('ipl.index', ['tab' => 'laporan'])->with('success', 'Data pemasukan berhasil ditambahkan.');
    }
    /**
     * Menghapus data pemasukan.
     */
  public function destroyPemasukan(Pemasukan $pemasukan)
    {
        if ($pemasukan->bukti) {
            Storage::disk('public')->delete($pemasukan->bukti);
        }
        $pemasukan->delete();

        // PERBAIKAN: Redirect ke halaman utama IPL dan buka tab laporan
        return redirect()->route('ipl.index', ['tab' => 'laporan'])->with('success', 'Data pemasukan berhasil dihapus.');
    }

    /**
     * Menyimpan data pengeluaran baru.
     */
    public function storePengeluaran(Request $request)
    {
        $request->validate([
            'tanggal_pengeluaran' => 'required|date',
            'keterangan' => 'required|string',
            'jumlah' => 'required|numeric|min:0',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti_pengeluaran', 'public');
        }

        Pengeluaran::create([
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            'keterangan' => $request->keterangan,
            'jumlah' => $request->jumlah,
            'bukti' => $path,
        ]);

        // PERBAIKAN: Redirect ke halaman utama IPL dan buka tab laporan
        return redirect()->route('ipl.index', ['tab' => 'laporan'])->with('success', 'Data pengeluaran berhasil ditambahkan.');
    }

        public function cetakLaporan(Request $request)
    {
        $bulan = (int)$request->input('bulan', now()->month);
        $tahun = (int)$request->input('tahun', now()->year);

        // Mengambil data yang sama persis seperti di method laporan()
        $pemasukanIuran = Iuran::where('status', 'Lunas')->whereMonth('tanggal_bayar', $bulan)->whereYear('tanggal_bayar', $tahun)->sum('jumlah_tagihan');
        $pemasukanLainQuery = Pemasukan::whereMonth('tanggal_pemasukan', $bulan)->whereYear('tanggal_pemasukan', $tahun);
        $totalPemasukanLain = $pemasukanLainQuery->sum('jumlah');
        $pemasukans = $pemasukanLainQuery->latest('tanggal_pemasukan')->get();
        $totalPemasukan = $pemasukanIuran + $totalPemasukanLain;

        $pengeluaranQuery = Pengeluaran::whereMonth('tanggal_pengeluaran', $bulan)->whereYear('tanggal_pengeluaran', $tahun);
        $totalPengeluaran = $pengeluaranQuery->sum('jumlah');
        $pengeluarans = $pengeluaranQuery->latest('tanggal_pengeluaran')->get();
        
        $saldo = $totalPemasukan - $totalPengeluaran;

        $data = [
            'bulan' => \Carbon\Carbon::create()->month($bulan)->translatedFormat('F'),
            'tahun' => $tahun,
            'pemasukanIuran' => $pemasukanIuran, 
            'totalPemasukan' => $totalPemasukan,
            'pemasukans' => $pemasukans,
            'pengeluarans' => $pengeluarans,
            'totalPengeluaran' => $totalPengeluaran,
            'saldo' => $saldo,
            'tanggal_cetak' => now()->translatedFormat('d F Y'),
            'ketua_rt' => 'Andi Nugroho', // Ganti nama
            'bendahara' => 'Riyat Pratama', // Ganti nama
        ];

        $pdf = PDF::loadView('ipl.laporan_pdf', $data);
        return $pdf->stream('laporan-keuangan-' . $bulan . '-' . $tahun . '.pdf');
    }

    /**
     * Menghapus data pengeluaran.
     */
    public function destroyPengeluaran(Pengeluaran $pengeluaran)
    {
        if ($pengeluaran->bukti) {
            Storage::disk('public')->delete($pengeluaran->bukti);
        }
        $pengeluaran->delete();
        
        // PERBAIKAN: Redirect ke halaman utama IPL dan buka tab laporan
        return redirect()->route('ipl.index', ['tab' => 'laporan'])->with('success', 'Data pengeluaran berhasil dihapus.');
    }

    /**
     * Helper untuk mendapatkan daftar bulan.
     */
    private function getMonths(): array {
        return ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    }
}