<x-app-layout>
    <x-slot name="header">
        <div class="bg-white shadow-lg px-6 py-4">
            <div class="flex justify-between items-center">
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    {{ __('Jurnal Kegiatan') }}
                </h2>
                <a href="{{ route('kegiatan.create') }}" class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-lg hover:bg-blue-700 focus:ring-blue-500 transition-all duration-200 shadow-md hover:shadow-lg text-sm uppercase tracking-widest">
                    + Tambah Kegiatan Baru
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 text-green-800 p-4 mb-8 rounded-lg shadow-sm" role="alert">
                    <p class="font-medium">{{ session('success') }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($kegiatans as $kegiatan)
                    <a href="{{ route('kegiatan.show', $kegiatan) }}" class="bg-white overflow-hidden shadow-lg sm:rounded-xl border border-gray-100 flex flex-col group transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                        <div class="relative">
                            @php
                                // Tampilkan foto 'after' pertama, jika tidak ada, tampilkan foto 'before' pertama
                                $fotoSampul = $kegiatan->fotosAfter->first() ?? $kegiatan->fotosBefore->first();
                            @endphp
                            @if ($fotoSampul)
                                <img src="{{ asset('storage/' . $fotoSampul->path) }}" alt="{{ $kegiatan->judul }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center rounded-t-xl">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent rounded-t-xl"></div>
                        </div>
                        <div class="p-6 flex-grow flex flex-col">
                            <p class="text-xs text-gray-500 uppercase tracking-wide">{{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d F Y') }}</p>
                            <h3 class="font-bold text-lg mt-2 group-hover:text-blue-600 transition-colors duration-200">{{ $kegiatan->judul }}</h3>
                            <p class="text-sm text-gray-600 mt-3 flex-grow">{{ Str::limit($kegiatan->deskripsi, 100) }}</p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 text-center py-12 bg-white rounded-xl shadow-lg border border-gray-100">
                        <p class="text-gray-500 text-lg font-medium">Belum ada kegiatan yang dicatat.</p>
                    </div>
                @endforelse
            </div>
            <div class="mt-10">
                {{ $kegiatans->links() }}
            </div>
        </div>
    </div>
</x-app-layout>