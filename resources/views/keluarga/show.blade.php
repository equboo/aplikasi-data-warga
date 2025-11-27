<x-app-layout>
  <div class="py-12" x-data="{ showAddForm: {{ $errors->any() ? 'true' : 'false' }} }">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <p>{{ session('success') }}</p>
            </div>
        @endif
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                <div class="flex items-center mb-2">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="font-semibold">Gagal Menambahkan Anggota</p>
                </div>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-lg rounded-xl overflow-hidden mb-8">
            <div class="p-8 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Informasi Keluarga
                </h3>
                <a href="{{ route('keluarga.edit', $kepalaKeluarga->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition duration-150 ease-in-out">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Informasi
                </a>
            </div>
            <div class="p-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Nomor KK</p>
                    <p class="font-semibold text-gray-900">{{ $kepalaKeluarga->nomor_kk }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Kepala Keluarga</p>
                    <p class="font-semibold text-gray-900">{{ $kepalaKeluarga->kepala_keluarga }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Status Kepemilikan Rumah</p>
                    <p class="font-semibold text-gray-900">{{ $kepalaKeluarga->status_rumah }}</p>
                </div>
                <div class="md:col-span-3 bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-500 mb-1">Alamat</p>
                    <p class="font-semibold text-gray-900">{{ $kepalaKeluarga->alamat }}, RT {{ $kepalaKeluarga->rt }}/RW {{ $kepalaKeluarga->rw }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white shadow-lg rounded-xl overflow-hidden mb-8">
            <div class="p-8 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Form Tambah Anggota Baru
                </h3>
                <button @click="showAddForm = !showAddForm" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition duration-150 ease-in-out">
                    <svg x-show="!showAddForm" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <svg x-show="showAddForm" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                    </svg>
                    <span x-show="!showAddForm">Buka Form</span>
                    <span x-show="showAddForm">Tutup Form</span>
                </button>
            </div>
            <div x-show="showAddForm" class="p-8 bg-gray-50" x-transition>
                <form method="POST" action="{{ route('keluarga.addMember', $kepalaKeluarga->id) }}">
                    @include('keluarga._form_tambah_anggota')
                </form>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <div class="p-8 border-b border-gray-200">
                <h3 class="text-2xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Daftar Anggota Keluarga Terdaftar
                </h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Lengkap</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hubungan Keluarga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Ayah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Ibu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Lahir</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($anggotaKeluarga as $anggota)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $anggota->nama_lengkap }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $anggota->hubungan_keluarga }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $anggota->nama_ayah }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $anggota->nama_ibu }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($anggota->tanggal_lahir)->translatedFormat('d F Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada anggota keluarga yang terdaftar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-8 flex items-center gap-4">
            <a href="{{ route('keluarga.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition duration-150 ease-in-out">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar Keluarga
            </a>
            <a href="{{ route('keluarga.cetak', $kepalaKeluarga->id) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition duration-150 ease-in-out">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Cetak Kartu Keluarga
            </a>
        </div>
    </div>
</div>
</x-app-layout>