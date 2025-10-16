<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Informasi Keluarga') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('keluarga.update', $keluarga->id) }}">
                        @csrf
                        @method('PUT')

                        <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Data Keluarga & Alamat</h3>
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div class="md:col-span-2">
                                <x-input-label for="nomor_kk" :value="__('Nomor Kartu Keluarga (KK)')" />
                                <x-text-input id="nomor_kk" class="block mt-1 w-full" type="text" name="nomor_kk" :value="old('nomor_kk', $keluarga->nomor_kk)" required />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="kepala_keluarga" :value="__('Nama Kepala Keluarga')" />
                                <x-text-input id="kepala_keluarga" class="block mt-1 w-full" type="text" name="kepala_keluarga" :value="old('kepala_keluarga', $keluarga->kepala_keluarga)" required />
                            </div>
                            <div class="md:col-span-4">
                                <x-input-label for="alamat" :value="__('Alamat')" />
                                <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat', $keluarga->alamat)" required />
                            </div>
                            <div>
                                <x-input-label for="rt" :value="__('RT')" />
                                <x-text-input id="rt" class="block mt-1 w-full" type="text" name="rt" :value="old('rt', $keluarga->rt)" required />
                            </div>
                            <div>
                                <x-input-label for="rw" :value="__('RW')" />
                                <x-text-input id="rw" class="block mt-1 w-full" type="text" name="rw" :value="old('rw', $keluarga->rw)" required />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="desa_kelurahan" :value="__('Desa/Kelurahan')" />
                                <x-text-input id="desa_kelurahan" class="block mt-1 w-full" type="text" name="desa_kelurahan" :value="old('desa_kelurahan', $keluarga->desa_kelurahan)" required />
                            </div>
                            <div>
                                <x-input-label for="kecamatan" :value="__('Kecamatan')" />
                                <x-text-input id="kecamatan" class="block mt-1 w-full" type="text" name="kecamatan" :value="old('kecamatan', $keluarga->kecamatan)" required />
                            </div>
                            <div>
                                <x-input-label for="kabupaten_kota" :value="__('Kabupaten/Kota')" />
                                <x-text-input id="kabupaten_kota" class="block mt-1 w-full" type="text" name="kabupaten_kota" :value="old('kabupaten_kota', $keluarga->kabupaten_kota)" required />
                            </div>
                            <div>
                                <x-input-label for="kode_pos" :value="__('Kode Pos')" />
                                <x-text-input id="kode_pos" class="block mt-1 w-full" type="text" name="kode_pos" :value="old('kode_pos', $keluarga->kode_pos)" required />
                            </div>
                            <div>
                                <x-input-label for="provinsi" :value="__('Provinsi')" />
                                <x-text-input id="provinsi" class="block mt-1 w-full" type="text" name="provinsi" :value="old('provinsi', $keluarga->provinsi)" required />
                            </div>
                            <div>
                                <x-input-label for="status_rumah" :value="__('Status Kepemilikan Rumah')" />
                                <select id="status_rumah" name="status_rumah" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="Milik Sendiri" @selected(old('status_rumah', $keluarga->status_rumah) == 'Milik Sendiri')>Milik Sendiri</option>
                                    <option value="Sewa/Kontrak" @selected(old('status_rumah', $keluarga->status_rumah) == 'Sewa/Kontrak')>Sewa/Kontrak</option>
                                    <option value="Numpang" @selected(old('status_rumah', $keluarga->status_rumah) == 'Numpang')>Numpang</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-8 border-t pt-6">
                            <a href="{{ route('keluarga.show', $keluarga->id) }}" class="text-sm text-gray-600 hover:text-gray-900 rounded-md">
                                Batal
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>