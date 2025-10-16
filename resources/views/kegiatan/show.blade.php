<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Album: {{ $kegiatan->judul }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d F Y') }}</p>
                            <h1 class="text-2xl font-bold mt-1">{{ $kegiatan->judul }}</h1>
                            <p class="mt-4 text-gray-700 whitespace-pre-wrap">{{ $kegiatan->deskripsi }}</p>
                        </div>
                        <form action="{{ route('kegiatan.destroy', $kegiatan->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus kegiatan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm bg-red-500 text-white font-semibold px-3 py-1 rounded-md hover:bg-red-600">Hapus Kegiatan</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @forelse ($kegiatan->fotos as $foto)
                    <div>
                        <a href="{{ asset('storage/' . $foto->path) }}" target="_blank">
                            <img src="{{ asset('storage/' . $foto->path) }}" alt="Dokumentasi" class="w-full h-48 object-cover rounded-lg shadow-md hover:shadow-xl transition-shadow">
                        </a>
                    </div>
                @empty
                    <p class="col-span-4 text-center text-gray-500">Tidak ada foto dokumentasi untuk kegiatan ini.</p>
                @endforelse
            </div>
            
            <div class="mt-6">
                <a href="{{ route('kegiatan.index') }}" class="text-sm text-gray-600 hover:text-gray-800">&larr; Kembali ke Jurnal Kegiatan</a>
            </div>
        </div>
    </div>
</x-app-layout>