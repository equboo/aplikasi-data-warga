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
            <p class="font-semibold">Gagal!</p>
        </div>
        <ul class="list-disc list-inside space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white shadow-lg rounded-xl overflow-hidden">
    <div class="p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Laporan Arus Kas Periode: {{ \Carbon\Carbon::create()->month($bulan_laporan)->translatedFormat('F') }} {{ $tahun_laporan }}
        </h3>
        
        <form method="GET" action="{{ route('ipl.index') }}" class="bg-gray-50 p-6 rounded-lg mb-8 shadow-sm">
            <input type="hidden" name="tab" value="laporan">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
                <div>
                    <x-input-label for="bulan_laporan" value="Pilih Bulan" class="text-sm font-medium text-gray-700" />
                    <select name="bulan_laporan" id="bulan_laporan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($months as $num => $name)
                            <option value="{{ $num + 1 }}" @selected($bulan_laporan == $num + 1)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input-label for="tahun_laporan" value="Pilih Tahun" class="text-sm font-medium text-gray-700" />
                    <select name="tahun_laporan" id="tahun_laporan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($years as $year)
                            <option value="{{ $year }}" @selected($tahun_laporan == $year)>{{ $year }}</option>
                        @endforeach
                        @if(!in_array(now()->year, $years->toArray()))
                             <option value="{{ now()->year }}" @selected($tahun_laporan == now()->year)>{{ now()->year }}</option>
                        @endif
                    </select>
                </div>
                <div class="flex gap-3">
                    <x-primary-button class="w-full md:w-auto bg-blue-600 hover:bg-blue-700">Tampilkan</x-primary-button>
                    <a href="{{ route('laporan.cetak', ['bulan' => $bulan_laporan, 'tahun' => $tahun_laporan]) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition duration-150 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak Laporan
                    </a>
                </div>
            </div>
        </form>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-r from-green-400 to-green-500 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm opacity-80">Total Pemasukan</div>
                        <div class="text-3xl font-bold">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                    </svg>
                </div>
            </div>
            <div class="bg-gradient-to-r from-red-400 to-red-500 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm opacity-80">Total Pengeluaran</div>
                        <div class="text-3xl font-bold">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                    </svg>
                </div>
            </div>
            <div class="bg-gradient-to-r from-blue-400 to-blue-500 text-white p-6 rounded-xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm opacity-80">Saldo Akhir</div>
                        <div class="text-3xl font-bold">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Tambah Pemasukan Lain
            </h3>
            <form method="POST" action="{{ route('pemasukan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <x-input-label for="tanggal_pemasukan" value="Tanggal" class="text-sm font-medium text-gray-700" />
                        <x-text-input id="tanggal_pemasukan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" type="date" name="tanggal_pemasukan" value="{{ old('tanggal_pemasukan', now()->format('Y-m-d')) }}" required />
                    </div>
                    <div>
                        <x-input-label for="keterangan_pemasukan" value="Keterangan" class="text-sm font-medium text-gray-700" />
                        <x-text-input id="keterangan_pemasukan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" type="text" name="keterangan" :value="old('keterangan')" required />
                    </div>
                    <div>
                        <x-input-label for="jumlah_pemasukan" value="Jumlah (Rp)" class="text-sm font-medium text-gray-700" />
                        <x-text-input id="jumlah_pemasukan" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500" type="number" name="jumlah" :value="old('jumlah')" required />
                    </div>
                    <div>
                        <x-input-label for="bukti_pemasukan" value="Bukti (Opsional, Gambar/PDF)" class="text-sm font-medium text-gray-700" />
                        <input id="bukti_pemasukan" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-green-500 focus:border-green-500" type="file" name="bukti">
                    </div>
                    <div class="flex justify-end">
                        <x-primary-button class="bg-green-600 hover:bg-green-700">Simpan Pemasukan</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                Tambah Pengeluaran
            </h3>
            <form method="POST" action="{{ route('pengeluaran.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">
                    <div>
                        <x-input-label for="tanggal_pengeluaran" value="Tanggal" class="text-sm font-medium text-gray-700" />
                        <x-text-input id="tanggal_pengeluaran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500" type="date" name="tanggal_pengeluaran" value="{{ old('tanggal_pengeluaran', now()->format('Y-m-d')) }}" required />
                    </div>
                    <div>
                        <x-input-label for="keterangan_pengeluaran" value="Keterangan" class="text-sm font-medium text-gray-700" />
                        <x-text-input id="keterangan_pengeluaran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500" type="text" name="keterangan" :value="old('keterangan')" required />
                    </div>
                    <div>
                        <x-input-label for="jumlah_pengeluaran" value="Jumlah (Rp)" class="text-sm font-medium text-gray-700" />
                        <x-text-input id="jumlah_pengeluaran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500" type="number" name="jumlah" :value="old('jumlah')" required />
                    </div>
                    <div>
                        <x-input-label for="bukti_pengeluaran" value="Bukti (Opsional, Gambar/PDF)" class="text-sm font-medium text-gray-700" />
                        <input id="bukti_pengeluaran" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:ring-red-500 focus:border-red-500" type="file" name="bukti">
                    </div>
                    <div class="flex justify-end">
                        <x-primary-button class="bg-red-600 hover:bg-red-700">Simpan Pengeluaran</x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-3 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Riwayat Pemasukan Lain
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($pemasukans as $item)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal_pemasukan)->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $item->keterangan }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 text-right font-medium">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    @if($item->bukti)
                                        <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">Lihat</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <form action="{{ route('pemasukan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pemasukan ini?');" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data pemasukan lain.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="p-8">
            <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                <svg class="w-6 h-6 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                Riwayat Pengeluaran
            </h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($pengeluarans as $item)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $item->keterangan }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 text-right font-medium">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    @if($item->bukti)
                                        <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition duration-150 ease-in-out">Lihat</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <form action="{{ route('pengeluaran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition duration-150 ease-in-out">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data pengeluaran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>