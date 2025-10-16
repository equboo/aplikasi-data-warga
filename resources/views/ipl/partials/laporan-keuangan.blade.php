@if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert"><p>{{ session('success') }}</p></div>
@endif
@if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
        <p class="font-bold">Gagal!</p>
        <ul class="list-disc list-inside">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h3 class="text-lg font-bold mb-4">Laporan Arus Kas Periode: {{ \Carbon\Carbon::create()->month($bulan_laporan)->translatedFormat('F') }} {{ $tahun_laporan }}</h3>
        
        <form method="GET" action="{{ route('ipl.index') }}" class="flex flex-col sm:flex-row gap-4 items-center p-4 bg-gray-50 rounded-lg mb-6">
            <input type="hidden" name="tab" value="laporan">
            <div class="flex-grow">
                <x-input-label for="bulan_laporan" value="Pilih Bulan" />
                <select name="bulan_laporan" id="bulan_laporan" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    @foreach ($months as $num => $name)
                        <option value="{{ $num + 1 }}" @selected($bulan_laporan == $num + 1)>{{ $name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex-grow">
                <x-input-label for="tahun_laporan" value="Pilih Tahun" />
                <select name="tahun_laporan" id="tahun_laporan" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    @foreach ($years as $year)
                        <option value="{{ $year }}" @selected($tahun_laporan == $year)>{{ $year }}</option>
                    @endforeach
                    @if(!in_array(now()->year, $years->toArray()))
                         <option value="{{ now()->year }}" @selected($tahun_laporan == now()->year)>{{ now()->year }}</option>
                    @endif
                </select>
            </div>
            <div class="self-end flex gap-2">
                <x-primary-button class="mt-1">Tampilkan</x-primary-button>
                <a href="{{ route('laporan.cetak', ['bulan' => $bulan_laporan, 'tahun' => $tahun_laporan]) }}" target="_blank" class="mt-1 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                    Cetak Laporan
                </a>
            </div>
        </form>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-green-100 border border-green-200 p-6 rounded-lg">
                <div class="text-sm text-green-700">Total Pemasukan</div>
                <div class="text-2xl font-bold text-green-800">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
            </div>
            <div class="bg-red-100 border border-red-200 p-6 rounded-lg">
                <div class="text-sm text-red-700">Total Pengeluaran</div>
                <div class="text-2xl font-bold text-red-800">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
            </div>
            <div class="bg-blue-100 border border-blue-200 p-6 rounded-lg">
                <div class="text-sm text-blue-700">Saldo Akhir</div>
                <div class="text-2xl font-bold text-blue-800">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-4">Tambah Pemasukan Lain</h3>
            <form method="POST" action="{{ route('pemasukan.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">
                    <div><x-input-label for="tanggal_pemasukan" value="Tanggal" /><x-text-input id="tanggal_pemasukan" class="mt-1 w-full" type="date" name="tanggal_pemasukan" value="{{ old('tanggal_pemasukan', now()->format('Y-m-d')) }}" required /></div>
                    <div><x-input-label for="keterangan_pemasukan" value="Keterangan" /><x-text-input id="keterangan_pemasukan" class="mt-1 w-full" type="text" name="keterangan" :value="old('keterangan')" required /></div>
                    <div><x-input-label for="jumlah_pemasukan" value="Jumlah (Rp)" /><x-text-input id="jumlah_pemasukan" class="mt-1 w-full" type="number" name="jumlah" :value="old('jumlah')" required /></div>
                    <div><x-input-label for="bukti_pemasukan" value="Bukti (Opsional, Gambar/PDF)" /><input id="bukti_pemasukan" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" type="file" name="bukti"></div>
                    <div class="flex justify-end"><x-primary-button>Simpan Pemasukan</x-primary-button></div>
                </div>
            </form>
        </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-4">Tambah Pengeluaran</h3>
            <form method="POST" action="{{ route('pengeluaran.store') }}" enctype="multipart/form-data">
                @csrf
                 <div class="space-y-4">
                    <div><x-input-label for="tanggal_pengeluaran" value="Tanggal" /><x-text-input id="tanggal_pengeluaran" class="mt-1 w-full" type="date" name="tanggal_pengeluaran" value="{{ old('tanggal_pengeluaran', now()->format('Y-m-d')) }}" required /></div>
                    <div><x-input-label for="keterangan_pengeluaran" value="Keterangan" /><x-text-input id="keterangan_pengeluaran" class="mt-1 w-full" type="text" name="keterangan" :value="old('keterangan')" required /></div>
                    <div><x-input-label for="jumlah_pengeluaran" value="Jumlah (Rp)" /><x-text-input id="jumlah_pengeluaran" class="mt-1 w-full" type="number" name="jumlah" :value="old('jumlah')" required /></div>
                    <div><x-input-label for="bukti_pengeluaran" value="Bukti (Opsional, Gambar/PDF)" /><input id="bukti_pengeluaran" class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" type="file" name="bukti"></div>
                    <div class="flex justify-end"><x-primary-button>Simpan Pengeluaran</x-primary-button></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
     <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-4">Riwayat Pemasukan Lain</h3>
            <div class="overflow-x-auto border rounded-lg">
                <table class="w-full bg-white">
                    <thead class="bg-gray-50"><tr><th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th><th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th><th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th><th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase">Bukti</th><th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th></tr></thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($pemasukans as $item)
                        <tr>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ \Carbon\Carbon::parse($item->tanggal_pemasukan)->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-sm">{{ $item->keterangan }}</td>
                            <td class="px-4 py-3 text-sm text-right">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if($item->bukti) <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a> @else - @endif
                            </td>
                            <td class="px-4 py-3">
                                <form action="{{ route('pemasukan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data pemasukan ini?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 text-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-4">Tidak ada data pemasukan lain.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
         <div class="p-6 text-gray-900">
            <h3 class="text-lg font-bold mb-4">Riwayat Pengeluaran</h3>
            <div class="overflow-x-auto border rounded-lg">
                <table class="w-full bg-white">
                    <thead class="bg-gray-50"><tr><th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th><th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase">Keterangan</th><th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th><th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase">Bukti</th><th class="py-2 px-4 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th></tr></thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($pengeluarans as $item)
                        <tr>
                            <td class="px-4 py-3 text-sm whitespace-nowrap">{{ \Carbon\Carbon::parse($item->tanggal_pengeluaran)->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-sm">{{ $item->keterangan }}</td>
                            <td class="px-4 py-3 text-sm text-right">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-sm">
                                @if($item->bukti) <a href="{{ asset('storage/' . $item->bukti) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a> @else - @endif
                            </td>
                            <td class="px-4 py-3"><form action="{{ route('pengeluaran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:text-red-900 text-sm">Hapus</button></form></td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-4">Tidak ada data pengeluaran.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>