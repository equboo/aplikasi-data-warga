<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Kegiatan: {{ $kegiatan->judul }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                            <p class="font-bold">Terjadi Kesalahan</p>
                            <ul class="list-disc list-inside mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('kegiatan.update', $kegiatan->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">

                            <div>
                                <x-input-label for="judul" value="Judul Kegiatan" />
                                <x-text-input id="judul" class="block mt-1 w-full" type="text"
                                    name="judul" :value="$kegiatan->judul" required />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="penanggung_jawab" value="Penanggung Jawab" />
                                    <x-text-input id="penanggung_jawab" class="block mt-1 w-full" type="text"
                                        name="penanggung_jawab" :value="$kegiatan->penanggung_jawab" required />
                                </div>
                                <div>
                                    <x-input-label for="tanggal_kegiatan" value="Tanggal Pelaksanaan" />
                                    <x-text-input id="tanggal_kegiatan" class="block mt-1 w-full" type="date"
                                        name="tanggal_kegiatan"
                                        :value="$kegiatan->tanggal_kegiatan" required />
                                </div>
                            </div>

                            <div>
                                <x-input-label for="peserta" value="Peserta Kegiatan" />
                                <x-text-input id="peserta" class="block mt-1 w-full" type="text"
                                    name="peserta" :value="$kegiatan->peserta" />
                            </div>

                            <div>
                                <x-input-label for="deskripsi" value="Deskripsi Singkat" />
                                <textarea id="deskripsi" name="deskripsi" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                                    rows="4" required>{{ $kegiatan->deskripsi }}</textarea>
                            </div>

                            <div>
                                <x-input-label for="biaya_pengeluaran" value="Biaya Pengeluaran (Opsional)" />
                                <x-text-input id="biaya_pengeluaran" class="block mt-1 w-full" type="number"
                                    name="biaya_pengeluaran"
                                    :value="$kegiatan->biaya_pengeluaran" />
                            </div>

                            {{-- Foto Sebelum --}}
                            <div class="space-y-3">
                                <x-input-label value="Foto Sebelum" />
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach ($kegiatan->fotosBefore as $foto)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/'.$foto->path) }}"
                                                 class="w-full h-32 object-cover rounded-lg shadow">
                                            <label class="absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition cursor-pointer">
                                                Hapus
                                                <input type="checkbox" name="delete_fotos[]" value="{{ $foto->id }}" class="hidden">
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <input type="file" name="fotos_before[]" multiple
                                       class="block w-full mt-2 border-gray-300 rounded-lg cursor-pointer" />
                            </div>

                            {{-- Foto Sesudah --}}
                            <div class="space-y-3">
                                <x-input-label value="Foto Sesudah" />
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                    @foreach ($kegiatan->fotosAfter as $foto)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/'.$foto->path) }}"
                                                 class="w-full h-32 object-cover rounded-lg shadow">
                                            <label class="absolute top-2 right-2 bg-red-600 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition cursor-pointer">
                                                Hapus
                                                <input type="checkbox" name="delete_fotos[]" value="{{ $foto->id }}" class="hidden">
                                            </label>
                                        </div>
                                    @endforeach
                                </div>

                                <input type="file" name="fotos_after[]" multiple
                                       class="block w-full mt-2 border-gray-300 rounded-lg cursor-pointer" />
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('kegiatan.show', $kegiatan->id) }}"
                                  class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                                <x-primary-button>
                                    Perbarui Kegiatan
                                </x-primary-button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>
