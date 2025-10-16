<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Jurnal Kegiatan') }}
            </h2>
            <a href="{{ route('kegiatan.create') }}" class="bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 text-sm">
                + Tambah Kegiatan Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($kegiatans as $kegiatan)
                    <a href="{{ route('kegiatan.show', $kegiatan) }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col group transition-transform duration-300 hover:-translate-y-1">
                        <div class="relative">
                            @if ($kegiatan->fotos->isNotEmpty())
                                <img src="{{ asset('storage/' . $kegiatan->fotos->first()->path) }}" alt="{{ $kegiatan->judul }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent"></div>
                        </div>
                        <div class="p-6 flex-grow flex flex-col">
                            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d F Y') }}</p>
                            <h3 class="font-bold text-lg mt-1 group-hover:text-blue-600 transition-colors">{{ $kegiatan->judul }}</h3>
                            <p class="text-sm text-gray-600 mt-2 flex-grow">{{ Str::limit($kegiatan->deskripsi, 100) }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 bg-gray-50 rounded-lg">
                        <p class="text-gray-500 text-lg">Belum ada kegiatan yang dicatat.</p>
                        <p class="text-gray-400 mt-2">Silakan tambah kegiatan baru untuk memulai jurnal.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-8">
                {{ $kegiatans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>