<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\KegiatanFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index()
    {
        // Eager load the 'fotos' relationship to get the images efficiently
        $kegiatans = Kegiatan::with('fotos')->latest('tanggal_kegiatan')->paginate(9);
        return view('kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('kegiatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'fotos' => 'required|array', // Ensure 'fotos' is an array
            'fotos.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Use a transaction to ensure data integrity
        DB::transaction(function () use ($request) {
            $kegiatan = Kegiatan::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'tanggal_kegiatan' => $request->tanggal_kegiatan,
            ]);

            if ($request->hasFile('fotos')) {
                foreach ($request->file('fotos') as $foto) {
                    $path = $foto->store('dokumentasi-kegiatan', 'public');
                    $kegiatan->fotos()->create(['path' => $path]);
                }
            }
        });

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan baru berhasil ditambahkan.');
    }

    /**
     * Display the specified activity album.
     */
    public function show(Kegiatan $kegiatan)
    {
        // Load the activity with all its photos
        $kegiatan->load('fotos');
        return view('kegiatan.show', compact('kegiatan'));
    }

    public function destroy(Kegiatan $kegiatan)
    {
        // Delete all associated photos from storage first
        foreach ($kegiatan->fotos as $foto) {
            Storage::disk('public')->delete($foto->path);
        }

        // Delete the activity record (photos will be deleted from DB via cascade)
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }
}