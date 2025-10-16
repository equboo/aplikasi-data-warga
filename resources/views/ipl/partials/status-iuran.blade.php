@if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert"><p>{{ session('success') }}</p></div>
@endif
@if (session('error'))
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert"><p>{{ session('error') }}</p></div>
@endif

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6 text-gray-900">
        <div class="md:flex md:justify-between md:items-start mb-4">
            <div>
                <h3 class="text-lg font-bold">Iuran Periode: {{ \Carbon\Carbon::create()->month($bulan_status)->translatedFormat('F') }} {{ $tahun_status }}</h3>
                <p class="text-sm text-gray-600">Gunakan filter di bawah untuk mencari data atau membuat tagihan.</p>
            </div>
             @if (!$tagihanSudahAda)
                <form action="{{ route('ipl.generate') }}" method="POST" onsubmit="return confirm('Anda akan membuat tagihan untuk periode ini. Lanjutkan?');" class="mt-4 md:mt-0 md:flex-shrink-0">
                    @csrf
                    <input type="hidden" name="bulan" value="{{ $bulan_status }}">
                    <input type="hidden" name="tahun" value="{{ $tahun_status }}">
                    <x-primary-button class="bg-blue-600 hover:bg-blue-700 w-full md:w-auto">
                        Buat Tagihan Periode Ini
                    </x-primary-button>
                </form>
            @endif
        </div>
        
        <form method="GET" action="{{ route('ipl.index') }}" class="flex flex-wrap items-end gap-4 bg-gray-50 p-4 rounded-lg">
            <input type="hidden" name="tab" value="status">
            <div class="flex-grow">
                <x-input-label for="search_status" value="Cari Nama" />
                <x-text-input id="search_status" name="search_status" type="text" class="mt-1 block w-full" placeholder="Nama kepala keluarga..." :value="request('search_status')" />
            </div>
            
            <div>
                <x-input-label for="bulan_status" value="Bulan" />
                <select name="bulan_status" id="bulan_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @foreach ($months as $num => $name)
                        <option value="{{ $num + 1 }}" @selected($bulan_status == $num + 1)>{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-input-label for="tahun_status" value="Tahun" />
                <select name="tahun_status" id="tahun_status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @foreach ($years as $year)
                        <option value="{{ $year }}" @selected($tahun_status == $year)>{{ $year }}</option>
                    @endforeach
                    @if(!in_array(now()->year, $years->toArray()))
                         <option value="{{ now()->year }}" @selected($tahun_status == now()->year)>{{ now()->year }}</option>
                    @endif
                </select>
            </div>

            <div>
                <x-input-label for="status_pembayaran" value="Status Bayar" />
                <select name="status_pembayaran" id="status_pembayaran" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="semua" @selected(request('status_pembayaran') == 'semua')>Semua Status</option>
                    <option value="Lunas" @selected(request('status_pembayaran') == 'Lunas')>Lunas</option>
                    <option value="Belum Lunas" @selected(request('status_pembayaran') == 'Belum Lunas')>Belum Lunas</option>
                </select>
            </div>
            
            <div class="flex gap-2">
                <x-primary-button>Filter</x-primary-button>
                <a href="{{ route('ipl.cetak', request()->query()) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
                    Cetak
                </a>
            </div>
        </form>
    </div>

    @if ($tagihanSudahAda)
    <div class="p-6 border-t grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-green-50 border border-green-200 p-4 rounded-lg text-center"><div class="text-sm text-green-700">Sudah Lunas</div><div class="text-2xl font-bold text-green-800">{{ $totalLunas }} Keluarga</div></div>
        <div class="bg-red-50 border border-red-200 p-4 rounded-lg text-center"><div class="text-sm text-red-700">Belum Lunas</div><div class="text-2xl font-bold text-red-800">{{ $totalBelumLunas }} Keluarga</div></div>
    </div>
    @endif
</div>

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h3 class="text-lg font-bold mb-4">Status Pembayaran Warga</h3>
        <div class="overflow-x-auto border rounded-lg">
            <table class="w-full bg-white">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">No.</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Nama Kepala Keluarga</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Alamat</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($kepalaKeluargas as $keluarga)
                        @php $iuran = $iurans->get($keluarga->id); @endphp
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 text-center">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4">{{ $keluarga->nama_lengkap }}</td>
                            <td class="py-3 px-4 text-sm">{{ $keluarga->alamat }}</td>
                            <td class="py-3 px-4 text-center">
                                @if ($iuran)
                                    @if ($iuran->status == 'Lunas')
                                        <div class="flex flex-col items-center">
                                            <div class="flex items-center gap-2">
                                                <span class="bg-green-200 text-green-800 text-xs font-semibold px-2.5 py-0.5 rounded-full">LUNAS</span>
                                                <form action="{{ route('ipl.batalkan', $iuran->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin membatalkan status lunas ini?');">
                                                    @csrf 
                                                    @method('PATCH')
                                                    <button type="submit" class="text-xs text-gray-500 hover:text-gray-700 hover:underline" title="Batalkan">(Batalkan)</button>
                                                </form>
                                            </div>
                                            <span class="text-xs text-gray-500 mt-1">
                                                Tgl. Bayar: {{ \Carbon\Carbon::parse($iuran->tanggal_bayar)->format('d M Y') }}
                                            </span>
                                        </div>
                                    @else
                                        <form action="{{ route('ipl.bayar', $iuran->id) }}" method="POST">
                                            @csrf 
                                            @method('PATCH')
                                            <button type="submit" class="text-sm bg-green-600 text-white font-semibold px-3 py-1 rounded-md hover:bg-green-700">Tandai Lunas</button>
                                        </form>
                                    @endif
                                @else
                                    <span class="text-gray-400 text-xs italic">Tagihan belum dibuat</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center py-4">Tidak ada data warga yang cocok dengan filter.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>