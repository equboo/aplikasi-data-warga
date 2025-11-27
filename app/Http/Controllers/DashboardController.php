<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\RiwayatSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class DashboardController extends Controller
{
    public function index()
    {
        // --- DATA UNTUK KARTU STATISTIK ---
        $totalWarga = Warga::count();
        $totalKeluarga = Warga::distinct('nomor_kk')->count('nomor_kk');
        $suratBulanIni = RiwayatSurat::whereMonth('created_at', now()->month)->count();
        $riwayatTerbaru = RiwayatSurat::with('warga')->latest()->take(5)->get();

        // --- DATA UNTUK DIAGRAM JENIS KELAMIN ---
        $genderData = Warga::query()
            ->select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->pluck('total', 'jenis_kelamin');
        
        $genderLabels = $genderData->keys();
        $genderCounts = $genderData->values();

        // --- DATA UNTUK DIAGRAM KELOMPOK USIA ---
        $ageGroups = Warga::query()
            ->select(DB::raw("
                CASE
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 5 THEN 'Balita (0-5)'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 6 AND 12 THEN 'Anak-anak (6-12)'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 13 AND 19 THEN 'Remaja (13-19)'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 20 AND 59 THEN 'Dewasa (20-59)'
                    ELSE 'Lansia (60+)'
                END as age_group
            "), DB::raw('count(*) as total'))
            ->groupBy('age_group')
            ->orderByRaw("FIELD(age_group, 'Balita (0-5)', 'Anak-anak (6-12)', 'Remaja (13-19)', 'Dewasa (20-59)', 'Lansia (60+)')")
            ->pluck('total', 'age_group');

        $ageLabels = $ageGroups->keys();
        $ageCounts = $ageGroups->values();

        // --- DATA BARU UNTUK DIAGRAM PENDIDIKAN ---
        $educationData = Warga::query()
            ->select('pendidikan', DB::raw('count(*) as total'))
            ->whereNotNull('pendidikan')
            ->groupBy('pendidikan')
            ->orderBy('total', 'desc')
            ->pluck('total', 'pendidikan');

        $educationLabels = $educationData->keys();
        $educationCounts = $educationData->values();

        // --- DATA BARU UNTUK DIAGRAM AGAMA ---
        $religionData = Warga::query()
            ->select('agama', DB::raw('count(*) as total'))
            ->whereNotNull('agama')
            ->groupBy('agama')
            ->orderBy('total', 'desc')
            ->pluck('total', 'agama');

        $religionLabels = $religionData->keys();
        $religionCounts = $religionData->values();

        // Kirim semua data yang sudah diolah ke view
        return view('dashboard', compact(
            'totalWarga',
            'totalKeluarga',
            'suratBulanIni',
            'riwayatTerbaru',
            'genderLabels', 
            'genderCounts',
            'ageLabels',
            'ageCounts',
            'educationLabels',
            'educationCounts',
            'religionLabels',
            'religionCounts'
        ));
    }
    public function cetakDashboard()
    {
        // --- AMBIL SEMUA DATA STATISTIK (SAMA SEPERTI METHOD INDEX) ---

        // Jenis Kelamin
        $genderData = Warga::query()
            ->select('jenis_kelamin', DB::raw('count(*) as total'))
            ->groupBy('jenis_kelamin')
            ->pluck('total', 'jenis_kelamin');

        // Kelompok Usia
        $ageGroups = Warga::query()
            ->select(DB::raw("
                CASE
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 5 THEN 'Balita (0-5)'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 6 AND 12 THEN 'Anak-anak (6-12)'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 13 AND 19 THEN 'Remaja (13-19)'
                    WHEN TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 20 AND 59 THEN 'Dewasa (20-59)'
                    ELSE 'Lansia (60+)'
                END as age_group
            "), DB::raw('count(*) as total'))
            ->groupBy('age_group')
            ->orderByRaw("FIELD(age_group, 'Balita (0-5)', 'Anak-anak (6-12)', 'Remaja (13-19)', 'Dewasa (20-59)', 'Lansia (60+)')")
            ->pluck('total', 'age_group');

        // Pendidikan
        $educationData = Warga::query()
            ->select('pendidikan', DB::raw('count(*) as total'))
            ->whereNotNull('pendidikan')->where('pendidikan', '!=', '')
            ->groupBy('pendidikan')
            ->orderBy('total', 'desc')
            ->pluck('total', 'pendidikan');

        // Agama
        $religionData = Warga::query()
            ->select('agama', DB::raw('count(*) as total'))
            ->whereNotNull('agama')->where('agama', '!=', '')
            ->groupBy('agama')
            ->orderBy('total', 'desc')
            ->pluck('total', 'agama');

        $data = [
            'genderData' => $genderData,
            'ageGroups' => $ageGroups,
            'educationData' => $educationData,
            'religionData' => $religionData,
            'tanggal_cetak' => now()->translatedFormat('d F Y'),
            'ketua_rt' => 'Andi Nugroho', // Ganti dengan nama ketua RT
        ];

        // Muat view PDF
        $pdf = PDF::loadView('dashboard_pdf', $data);
        return $pdf->stream('laporan-statistik-kependudukan.pdf');
    }
}