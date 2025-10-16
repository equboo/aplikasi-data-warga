<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Anggota Keluarga') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ showAddForm: {{ $errors->any() ? 'true' : 'false' }} }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Gagal Menambahkan Anggota</p>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 border-b flex justify-between items-center">
                    <h3 class="text-lg font-bold">Informasi Keluarga</h3>
                    <a href="{{ route('keluarga.edit', $kepalaKeluarga->id) }}" class="text-sm bg-gray-900 text-white font-semibold px-3 py-1 rounded-md hover:bg-gray-600 transition-colors duration-150">
                        Edit Informasi
                    </a>
                </div>
                <div class="p-6 text-gray-900 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-sm text-gray-500">Nomor KK</p>
                        <p class="font-semibold">{{ $kepalaKeluarga->nomor_kk }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Kepala Keluarga</p>
                        <p class="font-semibold">{{ $kepalaKeluarga->kepala_keluarga }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Status Kepemilikan Rumah</p>
                        <p class="font-semibold">{{ $kepalaKeluarga->status_rumah }}</p>
                    </div>
                    <div class="md:col-span-3">
                        <p class="text-sm text-gray-500">Alamat</p>
                        <p class="font-semibold">{{ $kepalaKeluarga->alamat }}, RT {{ $kepalaKeluarga->rt }}/RW {{ $kepalaKeluarga->rw }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 border-b flex justify-between items-center">
                    <h3 class="text-lg font-bold">Form Tambah Anggota Baru</h3>
                    <button @click="showAddForm = !showAddForm" class="bg-gray-900 text-white font-bold py-2 px-4 rounded-lg hover:bg-gray-600 text-sm">
                        <span x-show="!showAddForm">+ Buka Form</span>
                        <span x-show="showAddForm">Tutup Form</span>
                    </button>
                </div>
                <div x-show="showAddForm" class="p-6 bg-gray-50" x-transition>
                    <form method="POST" action="{{ route('keluarga.addMember', $kepalaKeluarga->id) }}">
                        @include('keluarga._form_tambah_anggota')
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 border-b">
                    <h3 class="text-lg font-bold">Daftar Anggota Keluarga Terdaftar</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Nama Lengkap</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Hubungan Keluarga</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Nama Ayah</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Nama Ibu</th>
                                <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Tanggal Lahir</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @forelse ($anggotaKeluarga as $anggota)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $anggota->nama_lengkap }}</td>
                                <td class="py-3 px-4">{{ $anggota->hubungan_keluarga }}</td>
                                <td class="py-3 px-4">{{ $anggota->nama_ayah }}</td>
                                <td class="py-3 px-4">{{ $anggota->nama_ibu }}</td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d F Y') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">Belum ada anggota keluarga yang terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-6 flex items-center gap-4">
                <a href="{{ route('keluarga.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                    Kembali ke Daftar Keluarga
                </a>
                <a href="{{ route('keluarga.cetak', $kepalaKeluarga->id) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                    Cetak Kartu Keluarga
                </a>
            </div>
        </div>
    </div>
</x-app-layout>