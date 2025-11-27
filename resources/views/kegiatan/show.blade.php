<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Album: {{ $kegiatan->judul }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Informasi Kegiatan --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border border-gray-100">
                <div class="p-8 text-gray-900 space-y-8">

                    {{-- Bagian Header: Judul dan Tombol Aksi --}}
                    <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-6 pb-6 border-b border-gray-200">
                        {{-- Kiri: Judul dan Tanggal --}}
                        <div class="flex-grow min-w-0">
                            <p class="text-sm text-gray-500 uppercase tracking-wide">
                                {{ \Carbon\Carbon::parse($kegiatan->tanggal_kegiatan)->translatedFormat('d F Y') }}
                            </p>
                            <h1 class="text-4xl font-bold mt-2 break-words text-gray-800">
                                {{ $kegiatan->judul }}
                            </h1>
                        </div>

                        {{-- Kanan: Tombol Aksi --}}
                        <div class="flex-shrink-0 flex flex-wrap gap-3">
                            {{-- Edit Kegiatan --}}
                            <a href="{{ route('kegiatan.edit', $kegiatan->id) }}"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg hover:from-yellow-600 hover:to-yellow-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Edit
                            </a>

                            {{-- Hapus Kegiatan --}}
                            <form action="{{ route('kegiatan.destroy', $kegiatan->id) }}" method="POST"
                                onsubmit="return confirm('Anda yakin ingin menghapus kegiatan ini?');" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-red-500 to-red-600 rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus
                                </button>
                            </form>

                            {{-- Download PDF --}}
                            <a href="{{ route('kegiatan.cetak', $kegiatan->id) }}" target="_blank"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Download
                            </a>
                        </div>
                    </div>

                    {{-- Bagian Konten: Deskripsi dan Detail --}}
                    <div class="space-y-8">

                        {{-- Deskripsi --}}
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Deskripsi Kegiatan
                            </h3>
                            <p class="text-gray-700 whitespace-pre-line leading-relaxed bg-gray-50 p-4 rounded-lg border-l-4 border-blue-500">
                                {{ $kegiatan->deskripsi }}
                            </p>
                        </div>

                        {{-- Detail (Grid Simetris) --}}
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-6 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                Detail Kegiatan
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Penanggung Jawab</p>
                                    <p class="mt-2 text-gray-900 font-semibold text-lg">{{ $kegiatan->penanggung_jawab }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Peserta</p>
                                    <p class="mt-2 text-gray-900 text-lg">{{ $kegiatan->peserta ?? '-' }}</p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:shadow-md transition-shadow">
                                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Biaya Pengeluaran</p>
                                    <p class="mt-2 text-gray-900 font-semibold text-lg">
                                        {{ $kegiatan->biaya_pengeluaran ? 'Rp '.number_format($kegiatan->biaya_pengeluaran,0,',','.') : '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Foto Sebelum --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border border-gray-100 p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-8 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Dokumentasi Sebelum
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse ($kegiatan->fotosBefore as $foto)
                        <div class="relative group aspect-square overflow-hidden rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <a href="{{ asset('storage/'.$foto->path) }}" target="_blank" class="block w-full h-full">
                                <img src="{{ asset('storage/'.$foto->path) }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                            </a>
                            {{-- Overlay on hover --}}
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            {{-- Tombol hapus foto --}}
                            <form action="{{ route('kegiatan.foto.destroy', [$kegiatan->id, $foto->id]) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus foto ini?');"
                                  class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white rounded-full px-3 py-2 text-sm font-bold hover:bg-red-700 transition-colors shadow-lg">
                                    ×
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500 text-lg">Tidak ada dokumentasi sebelum.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Foto Sesudah --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border border-gray-100 p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-8 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Dokumentasi Sesudah
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @forelse ($kegiatan->fotosAfter as $foto)
                        <div class="relative group aspect-square overflow-hidden rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <a href="{{ asset('storage/'.$foto->path) }}" target="_blank" class="block w-full h-full">
                                <img src="{{ asset('storage/'.$foto->path) }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                            </a>
                            {{-- Overlay on hover --}}
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center">
                                <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            {{-- Tombol hapus foto --}}
                            <form action="{{ route('kegiatan.foto.destroy', [$kegiatan->id, $foto->id]) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus foto ini?');"
                                  class="absolute top-3 right-3 opacity-0 group-hover:opacity-100 transition-opacity">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white rounded-full px-3 py-2 text-sm font-bold hover:bg-red-700 transition-colors shadow-lg">
                                    ×
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-gray-500 text-lg">Tidak ada dokumentasi sesudah.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Tombol kembali --}}
            <div class="text-center py-8">
                <a href="{{ route('kegiatan.index') }}"
                    class="inline-flex items-center px-6 py-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200 shadow-sm hover:shadow-md">
                          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    &larr; Kembali ke Jurnal Kegiatan
                </a>
            </div>

        </div>
    </div>
</x-app-layout>