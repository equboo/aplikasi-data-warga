@if (session('success'))
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
        </svg>
        <p>{{ session('success') }}</p>
    </div>
@endif
@if (session('error'))
    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
        </svg>
        <p>{{ session('error') }}</p>
    </div>
@endif

<div class="bg-white shadow-lg rounded-xl overflow-hidden mb-8">
    <div class="p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
            <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
            </svg>
            Filter Data Iuran
        </h3>
        <p class="text-sm text-gray-600 mb-6">Gunakan filter di bawah untuk mencari data.</p>
        
        <form method="GET" action="{{ route('ipl.index') }}" class="bg-gray-50 p-6 rounded-lg shadow-sm">
            <input type="hidden" name="tab" value="status">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-6 items-end">
                <div>
                    <x-input-label for="search_status" value="Cari Nama" class="text-sm font-medium text-gray-700" />
                    <x-text-input id="search_status" name="search_status" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Nama kepala keluarga..." :value="request('search_status')" />
                </div>
                <div>
                    <x-input-label for="bulan_status" value="Bulan" class="text-sm font-medium text-gray-700" />
                    <select name="bulan_status" id="bulan_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($months as $num => $name)
                            <option value="{{ $num + 1 }}" @selected($bulan_status == $num + 1)>{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <x-input-label for="tahun_status" value="Tahun" class="text-sm font-medium text-gray-700" />
                    <select name="tahun_status" id="tahun_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($years as $year)
                            <option value="{{ $year }}" @selected($tahun_status == $year)>{{ $year }}</option>
                        @endforeach
                        @if(!in_array(now()->year, $years->toArray()))
                             <option value="{{ now()->year }}" @selected($tahun_status == now()->year)>{{ now()->year }}</option>
                        @endif
                    </select>
                </div>
                <div>
                    <x-input-label for="status_pembayaran" value="Status Bayar" class="text-sm font-medium text-gray-700" />
                    <select name="status_pembayaran" id="status_pembayaran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="semua" @selected(request('status_pembayaran') == 'semua')>Semua Status</option>
                        <option value="Lunas" @selected(request('status_pembayaran') == 'Lunas')>Lunas</option>
                        <option value="Belum Lunas" @selected(request('status_pembayaran') == 'Belum Lunas')>Belum Lunas</option>
                    </select>
                </div>
                <div class="flex gap-3">
                    <x-primary-button class="w-full md:w-auto bg-blue-600 hover:bg-blue-700">Filter</x-primary-button>
                    <a href="{{ route('ipl.cetak', request()->query()) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition duration-150 ease-in-out">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="bg-white shadow-lg rounded-xl overflow-hidden mb-8">
    <div class="p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            Statistik & Aksi Periode: {{ \Carbon\Carbon::create()->month($bulan_status)->translatedFormat('F') }} {{ $tahun_status }}
        </h3>
        
        @if ($tagihanSudahAda)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-gradient-to-r from-green-400 to-green-500 text-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm opacity-80">Sudah Lunas</div>
                            <div class="text-3xl font-bold">{{ $totalLunas }} Keluarga</div>
                        </div>
                        <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <div class="bg-gradient-to-r from-red-400 to-red-500 text-white p-6 rounded-xl shadow-lg">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm opacity-80">Belum Lunas</div>
                            <div class="text-3xl font-bold">{{ $totalBelumLunas }} Keluarga</div>
                        </div>
                        <svg class="w-12 h-12 opacity-80" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            
            <div class="text-center">
                <form action="{{ route('ipl.batalkanTagihan') }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan semua tagihan bulan {{ \Carbon\Carbon::create()->month($bulan_status)->translatedFormat('F') }} {{ $tahun_status }}? Semua data pembayaran akan dihapus!');">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="bulan" value="{{ $bulan_status }}">
                    <input type="hidden" name="tahun" value="{{ $tahun_status }}">
                    <x-danger-button class="bg-red-600 hover:bg-red-700 text-white">Batalkan Tagihan</x-danger-button>
                </form>
            </div>
        @else
            <div class="text-center">
                <p class="text-sm text-gray-600 mb-4">Tagihan untuk periode ini belum dibuat.</p>
                <form action="{{ route('ipl.generate') }}" method="POST" onsubmit="return confirm('Anda akan membuat tagihan untuk periode ini. Lanjutkan?');">
                    @csrf
                    <input type="hidden" name="bulan" value="{{ $bulan_status }}">
                    <input type="hidden" name="tahun" value="{{ $tahun_status }}">
                    <x-primary-button class="bg-blue-600 hover:bg-blue-700 text-white">Buat Tagihan</x-primary-button>
                </form>
            </div>
        @endif
    </div>
</div>

<div class="bg-white shadow-lg rounded-xl overflow-hidden">
    <div class="p-8">
        <h3 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
            <svg class="w-6 h-6 mr-3 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Status Pembayaran Warga
        </h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kepala Keluarga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($kepalaKeluargas as $keluarga)
                        @php $iuran = $iurans->get($keluarga->id); @endphp
                        <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 text-center">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $keluarga->nama_lengkap }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $keluarga->alamat }}</td>
                            <td class="px-6 py-4 text-center">
                                @if ($iuran)
                                    @if ($iuran->status == 'Lunas')
                                        <div class="flex flex-col items-center space-y-2">
                                            <div class="flex items-center space-x-2">
                                                <span class="bg-green-100 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">LUNAS</span>
                                                <form action="{{ route('ipl.batalkan', $iuran->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin membatalkan status lunas ini?');" class="inline">
                                                    @csrf 
                                                    @method('PATCH')
                                                    <button type="submit" class="text-xs text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out" title="Batalkan">(Batalkan)</button>
                                                </form>
                                            </div>
                                            <span class="text-xs text-gray-500">
                                                Tgl. Bayar: {{ \Carbon\Carbon::parse($iuran->tanggal_bayar)->format('d M Y') }}
                                            </span>
                                        </div>
                                    @else
                                        <form action="{{ route('ipl.bayar', $iuran->id) }}" method="POST" class="inline">
                                            @csrf 
                                            @method('PATCH')
                                            <button type="submit" class="bg-green-600 text-white text-sm font-semibold px-3 py-1 rounded-md hover:bg-green-700 transition duration-150 ease-in-out">Tandai Lunas</button>
                                        </form>
                                    @endif
                                @else
                                    <span class="text-gray-400 text-xs italic">Tagihan belum dibuat</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">Tidak ada data warga yang cocok dengan filter.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
