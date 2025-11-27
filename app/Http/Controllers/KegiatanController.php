<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\KegiatanFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PDF;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::with('fotosBefore', 'fotosAfter')
            ->latest('tanggal_kegiatan')
            ->paginate(9);

        return view('kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('kegiatan.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'penanggung_jawab' => 'required|string|max:255',
            'peserta' => 'nullable|string',
            'biaya_pengeluaran' => 'nullable|numeric|min:0',
            'fotos_before.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'fotos_after.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::transaction(function () use ($request, $data) {
            $kegiatan = Kegiatan::create($data);

            // FOTO BEFORE
            if ($request->hasFile('fotos_before')) {
                foreach ($request->file('fotos_before') as $file) {
                    $path = $file->store('kegiatan', 'public');
                    $kegiatan->fotos()->create([
                        'path' => $path,
                        'type' => 'before'
                    ]);
                }
            }

            // FOTO AFTER
            if ($request->hasFile('fotos_after')) {
                foreach ($request->file('fotos_after') as $file) {
                    $path = $file->store('kegiatan', 'public');
                    $kegiatan->fotos()->create([
                        'path' => $path,
                        'type' => 'after'
                    ]);
                }
            }
        });

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan baru berhasil ditambahkan.');
    }

    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load('fotosBefore', 'fotosAfter');
        return view('kegiatan.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        $kegiatan->load('fotosBefore', 'fotosAfter');
        return view('kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'penanggung_jawab' => 'required|string|max:255',
            'peserta' => 'nullable|string',
            'biaya_pengeluaran' => 'nullable|numeric|min:0',
            'delete_fotos' => 'nullable|array',
            'delete_fotos.*' => 'exists:kegiatan_fotos,id',
            'fotos_before.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'fotos_after.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        DB::transaction(function () use ($request, $data, $kegiatan) {
            $kegiatan->update($data);

            // Hapus foto yang dipilih
            if ($request->delete_fotos) {
                $fotos = KegiatanFoto::whereIn('id', $request->delete_fotos)->get();
                foreach ($fotos as $foto) {
                    Storage::disk('public')->delete($foto->path);
                    $foto->delete();
                }
            }

            // Upload tambahan foto BEFORE
            if ($request->hasFile('fotos_before')) {
                foreach ($request->file('fotos_before') as $file) {
                    $path = $file->store('kegiatan', 'public');
                    $kegiatan->fotos()->create([
                        'path' => $path,
                        'type' => 'before'
                    ]);
                }
            }

            // Upload tambahan foto AFTER
            if ($request->hasFile('fotos_after')) {
                foreach ($request->file('fotos_after') as $file) {
                    $path = $file->store('kegiatan', 'public');
                    $kegiatan->fotos()->create([
                        'path' => $path,
                        'type' => 'after'
                    ]);
                }
            }
        });

        return redirect()->route('kegiatan.show', $kegiatan->id)
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        foreach ($kegiatan->fotos as $foto) {
            Storage::disk('public')->delete($foto->path);
        }
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }

    // ✅ Fitur Hapus Foto Single (dipanggil dari show.blade) - DENGAN VALIDASI KEAMANAN TAMBAHAN
    public function deleteFoto(Kegiatan $kegiatan, KegiatanFoto $foto)
    {
        // Pastikan foto milik kegiatan ini untuk keamanan
        if ($foto->kegiatan_id !== $kegiatan->id) {
            abort(403, 'Unauthorized');
        }

        Storage::disk('public')->delete($foto->path);
        $foto->delete();

        return back()->with('success', 'Foto berhasil dihapus.');
    }

    public function cetakLaporan(Kegiatan $kegiatan)
    {
        $pdf = PDF::loadView('kegiatan.pdf', [
            'kegiatan' => $kegiatan,
            'tanggal_cetak' => now()->translatedFormat('d F Y'),
            'ketua_rt' => 'Andi Nugroho',
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('laporan-kegiatan-' . Str::slug($kegiatan->judul) . '.pdf');
    }
}