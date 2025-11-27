@if (session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <p>{{ session('success') }}</p>
    </div>
@endif

<div class="bg-white shadow-lg rounded-xl overflow-hidden mb-8">
    <div class="p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            Filter & Pencarian Data Keluarga
        </h3>
        
        <form method="GET" action="{{ route('manajemen.index') }}" class="bg-gray-50 p-6 rounded-lg shadow-sm">
            <input type="hidden" name="tab" value="keluarga">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                <div>
                    <x-input-label for="search_keluarga" value="Pencarian Keluarga" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="search_keluarga" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" type="text" name="search_keluarga" placeholder="Cari No. KK / Nama Kepala Keluarga / Alamat..." value="{{ request('search_keluarga') }}" />
                </div>
                <div class="flex gap-3">
                    <x-primary-button class="w-full md:w-auto bg-blue-600 hover:bg-blue-700">Cari</x-primary-button>
                    <a href="{{ route('manajemen.keluarga.cetak', request()->query()) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition duration-150 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Cetak PDF
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="bg-white shadow-lg rounded-xl overflow-hidden">
    <div class="p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Data Keluarga
        </h3>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-[5%]">No.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[20%]">No. KK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[20%]">Kepala Keluarga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[25%]">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Status Rumah</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-[15%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($kepalaKeluargas as $keluarga)
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $loop->index + $kepalaKeluargas->firstItem() }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $keluarga->nomor_kk }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $keluarga->kepala_keluarga }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $keluarga->alamat }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $keluarga->status_rumah }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('keluarga.show', $keluarga->id) }}" class="inline-flex items-center px-3 py-1 border border-green-600 text-green-600 text-sm font-medium rounded-md hover:bg-green-600 hover:text-white transition duration-150 ease-in-out">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat
                                    </a>
                                    <form action="{{ route('keluarga.destroy', $keluarga->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus seluruh keluarga ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-red-500 text-red-500 text-sm font-medium rounded-md hover:bg-red-500 hover:text-white transition duration-150 ease-in-out">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">Data keluarga tidak ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $kepalaKeluargas->appends(request()->query())->links('pagination::tailwind') }}
        </div>
    </div>
</div>