<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PDF;

class KeluargaController extends Controller
{
    /**
     * Menampilkan daftar semua kepala keluarga.
     */
    public function index()
{
    $kepalaKeluargas = Warga::where('hubungan_keluarga', 'Kepala Keluarga')
                            ->orderBy('kepala_keluarga', 'asc')
                            ->paginate(15);

    $wargas = Warga::orderBy('nama_lengkap', 'asc')->paginate(15);
    return view('manajemen.index', compact('kepalaKeluargas', 'wargas'));
}


    /**
     * Menampilkan form untuk membuat satu keluarga baru.
     */
    public function create()
    {
        return view('keluarga.create');
    }

    /**
     * Menyimpan data satu keluarga baru.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomor_kk' => 'required|digits:16|unique:wargas,nomor_kk',
            'alamat' => 'required|string',
            'rt' => 'required|string|max:3', 'rw' => 'required|string|max:3',
            'desa_kelurahan' => 'required|string', 'kecamatan' => 'required|string',
            'kabupaten_kota' => 'required|string', 'kode_pos' => 'required|string|max:5',
            'provinsi' => 'required|string', 'status_rumah' => 'required|string',
            'members' => 'required|array|min:1',
            'members.*.nik' => 'required|digits:16|distinct|unique:wargas,nik',
            'members.*.nama_lengkap' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kepalaKeluargaExists = collect($request->members)->contains('hubungan_keluarga', 'Kepala Keluarga');
        if (!$kepalaKeluargaExists) {
            return redirect()->back()->withErrors(['members' => 'Setidaknya harus ada satu anggota dengan status "Kepala Keluarga".'])->withInput();
        }

        DB::transaction(function () use ($request) {
            $kepalaKeluargaNama = '';
            foreach ($request->members as $member) {
                if ($member['hubungan_keluarga'] === 'Kepala Keluarga') {
                    $kepalaKeluargaNama = $member['nama_lengkap'];
                    break;
                }
            }

            foreach ($request->members as $member) {
                Warga::create(array_merge($request->only([
                    'nomor_kk', 'alamat', 'rt', 'rw', 'desa_kelurahan', 'kecamatan',
                    'kabupaten_kota', 'kode_pos', 'provinsi', 'status_rumah'
                ]), [
                    'kepala_keluarga' => $kepalaKeluargaNama,
                ], $member));
            }
        });

        return redirect()->route('manajemen.index')->with('success', 'Data keluarga baru berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail anggota dari sebuah keluarga.
     */
    public function show(Warga $keluarga)
    {
        $nomorKK = $keluarga->nomor_kk;
        $anggotaKeluarga = Warga::where('nomor_kk', $nomorKK)->orderBy('tanggal_lahir', 'asc')->get();
        return view('keluarga.show', ['kepalaKeluarga' => $keluarga, 'anggotaKeluarga' => $anggotaKeluarga]);
    }

    /**
     * Menampilkan form untuk mengedit informasi keluarga.
     */
    public function edit(Warga $keluarga)
    {
        return view('keluarga.edit', compact('keluarga'));
    }

    /**
     * Memperbarui informasi keluarga dan mensinkronisasikannya ke semua anggota.
     */
    public function update(Request $request, Warga $keluarga)
    {
        $originalNomorKk = $keluarga->nomor_kk;

        $request->validate([
            'nomor_kk' => 'required|digits:16|unique:wargas,nomor_kk,' . $originalNomorKk . ',nomor_kk',
            'kepala_keluarga' => 'required|string|max:255',
            'alamat' => 'required|string', 'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3', 'desa_kelurahan' => 'required|string',
            'kecamatan' => 'required|string', 'kabupaten_kota' => 'required|string',
            'kode_pos' => 'required|string|max:5', 'provinsi' => 'required|string',
            'status_rumah' => 'required|string',
        ]);

        Warga::where('nomor_kk', $originalNomorKk)->update($request->only([
            'nomor_kk', 'kepala_keluarga', 'alamat', 'rt', 'rw', 'desa_kelurahan',
            'kecamatan', 'kabupaten_kota', 'kode_pos', 'provinsi', 'status_rumah'
        ]));
        
        return redirect()->route('keluarga.show', $keluarga->id)
                        ->with('success', 'Informasi keluarga berhasil diperbarui untuk semua anggota.');
    }

    /**
     * Menghapus seluruh data keluarga.
     */
    public function destroy(Warga $keluarga)
    {
        Warga::where('nomor_kk', $keluarga->nomor_kk)->delete();
        return redirect()->route('manajemen.index')->with('success', 'Satu keluarga berhasil dihapus.');
    }

    /**
     * Mencetak Kartu Keluarga dalam format PDF.
     */
    public function cetakKK(Warga $keluarga)
    {
        $nomorKK = $keluarga->nomor_kk;
        $anggotaKeluarga = Warga::where('nomor_kk', $nomorKK)->orderBy('tanggal_lahir', 'asc')->get();
        $data = ['kepalaKeluarga' => $keluarga, 'anggotaKeluarga' => $anggotaKeluarga];
        $pdf = PDF::loadView('keluarga.kk_pdf_final', $data)->setPaper('a4', 'landscape');
        return $pdf->stream('kartu-keluarga-' . $nomorKK . '.pdf');
    }

    /**
     * Menambahkan anggota baru ke keluarga yang sudah ada.
     */
    public function addMember(Request $request, Warga $keluarga)
    {
        $request->validate([
            'nik' => 'required|digits:16|distinct|unique:wargas,nik',
            'nama_lengkap' => 'required|string|max:255',
        ]);

        Warga::create(array_merge($keluarga->only([
            'nomor_kk', 'kepala_keluarga', 'alamat', 'rt', 'rw', 'desa_kelurahan',
            'kecamatan', 'kabupaten_kota', 'kode_pos', 'provinsi', 'status_rumah'
        ]), $request->all()));

        return redirect()->route('keluarga.show', $keluarga->id)
                      ->with('success', 'Anggota keluarga baru berhasil ditambahkan.');
    }
}