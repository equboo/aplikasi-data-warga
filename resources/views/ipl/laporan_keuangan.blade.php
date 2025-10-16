<!DOCTYPE html>
<html>
<head>
    {{-- ... (style) ... --}}
</head>
<body>
    {{-- ... (kop surat) ... --}}

    <h3>I. PEMASUKAN</h3>
    <table class="main-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal</th>
                <th>Keterangan</th>
                <th style="width: 25%;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @if($pemasukanIuran > 0)
            <tr>
                <td style="text-align: center;">1</td>
                <td>Beragam Tanggal</td>
                <td>Pemasukan Iuran Warga</td>
                <td class="amount">Rp {{ number_format($pemasukanIuran, 0, ',', '.') }}</td>
            </tr>
            @endif
            @php $pemasukanCounter = $pemasukanIuran > 0 ? 2 : 1; @endphp
            @foreach($pemasukans as $item)
            <tr>
                <td style="text-align: center;">{{ $pemasukanCounter++ }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal_pemasukan)->format('d-m-Y') }}</td>
                <td>{{ $item->keterangan }}</td>
                <td class="amount">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" style="text-align: right; font-weight: bold;">TOTAL PEMASUKAN</td>
                <td class="amount" style="font-weight: bold;">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    {{-- ... (sisa dokumen) ... --}}
</body>
</html>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Arsip Laporan Keuangan</h3>
                    <div class="overflow-x-auto border rounded-lg">
                        <table class="w-full bg-white">
                            {{-- ... (Table headers: Periode, Tgl. Unggah, Aksi) ... --}}
                            <tbody>
                                @forelse ($laporans as $laporan)
                                <tr>
                                    <td class="py-3 px-4">Laporan Keuangan {{ \Carbon\Carbon::create()->month($laporan->bulan)->translatedFormat('F') }} {{ $laporan->tahun }}</td>
                                  <td class="py-3 px-4">{{ $laporan->created_at->format('d M Y') }}</td>
                                    <td class="py-3 px-4">
                                        <a href="{{ asset('storage/' . $laporan->path_file) }}" target="_blank" class="text-blue-600 hover:underline">Lihat/Unduh</a>
                                        <form method="POST" action="{{ route('ipl.hapus_laporan', $laporan->id) }}" class="inline ml-4" onsubmit="return confirm('Yakin hapus laporan ini?');">
                                            @csrf @method('DELETE')
                                              <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                          </form>
                                      </td>
                                  </tr>
                                  @empty
                                  <tr><td colspan="3" class="text-center py-4">Belum ada laporan yang diunggah.</td></tr>
                                  @endforelse
                              </tbody>
                          </table>
                      </div>
                  </div>
            </div>

        </div>
    </div>
</x-app-layout>