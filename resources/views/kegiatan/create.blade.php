<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kegiatan Baru') }}
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

                    <form method="POST" action="{{ route('kegiatan.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <x-input-label for="judul" value="Judul Kegiatan" />
                                <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul')" required />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="penanggung_jawab" value="Penanggung Jawab" />
                                    <x-text-input id="penanggung_jawab" class="block mt-1 w-full" type="text" name="penanggung_jawab" :value="old('penanggung_jawab')" required />
                                </div>
                                <div>
                                    <x-input-label for="tanggal_kegiatan" value="Tanggal Pelaksanaan" />
                                    <x-text-input id="tanggal_kegiatan" class="block mt-1 w-full" type="date" name="tanggal_kegiatan" :value="old('tanggal_kegiatan')" required />
                                </div>
                            </div>

                            <div>
                                    <x-input-label for="peserta" value="Peserta Kegiatan" />
                                    <x-text-input id="peserta" class="block mt-1 w-full" type="text" name="peserta" :value="old('peserta')" required />
                                </div>

                            <div>
                                <x-input-label for="deskripsi" value="Deskripsi Singkat" />
                                <textarea id="deskripsi" name="deskripsi" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" rows="4" required>{{ old('deskripsi') }}</textarea>
                            </div>

                            <div>
                                <x-input-label for="biaya_pengeluaran" value="Biaya Pengeluaran (Opsional)" />
                                <x-text-input id="biaya_pengeluaran" class="block mt-1 w-full" type="number" name="biaya_pengeluaran" :value="old('biaya_pengeluaran')" />
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-input-label for="fotos_before" value="Foto Sebelum (Opsional)" />
                                    <input id="fotos_before" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" type="file" name="fotos_before[]" multiple>
                                    <x-input-error :messages="$errors->get('foto_before')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="fotos_after" value="Foto Sesudah (Opsional)" />
                                    <input id="fotos_after" class="block mt-1 w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" type="file" name="fotos_after[]" multiple>
                                    <x-input-error :messages="$errors->get('foto_after')" class="mt-2" />
                                </div>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <a href="{{ route('kegiatan.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">Batal</a>
                                <x-primary-button>
                                    {{ __('Simpan Kegiatan') }}
                                </x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
