<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Transaksi & Tagihan Berjalan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Tagihan Bulan Ini ({{ now()->translatedFormat('F Y') }})</h3>
                    @if ($tagihanBulanBerjalan)
                        <div class="p-4 rounded-lg flex justify-between items-center {{ $tagihanBulanBerjalan->status == 'Lunas' ? 'bg-green-100' : 'bg-red-100' }}">
                            <div>
                                <p class="font-semibold">Jumlah: Rp {{ number_format($tagihanBulanBerjalan->jumlah_tagihan, 0, ',', '.') }}</p>
                                <p class="text-sm">Jatuh Tempo: 10 {{ now()->translatedFormat('F Y') }}</p>
                            </div>
                            <span class="font-bold text-lg {{ $tagihanBulanBerjalan->status == 'Lunas' ? 'text-green-700' : 'text-red-700' }}">
                                {{ $tagihanBulanBerjalan->status }}
                            </span>
                        </div>
                    @else
                        <p class="text-gray-500">Tidak ada tagihan untuk bulan ini.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Riwayat Pembayaran</h3>
                    <div class="overflow-x-auto border rounded-lg">
                        <table class="w-full bg-white">
                            {{-- ... (Table headers: Periode, Tgl. Bayar, Jumlah, Status) ... --}}
                            <tbody>
                                @forelse ($riwayatPembayaran as $iuran)
                                <tr>
                                    <td class="py-3 px-4">{{ \Carbon\Carbon::create()->month($iuran->bulan)->translatedFormat('F') }} {{ $iuran->tahun }}</td>
                                    <td class="py-3 px-4">{{ $iuran->tanggal_bayar ? \Carbon\Carbon::parse($iuran->tanggal_bayar)->format('d M Y') : '-' }}</td>
                                    <td class="py-3 px-4">Rp {{ number_format($iuran->jumlah_tagihan, 0, ',', '.') }}</td>
                                    <td class="py-3 px-4">
                                        <span class="{{ $iuran->status == 'Lunas' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }} text-xs font-semibold px-2.5 py-0.5 rounded-full">{{ $iuran->status }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center py-4">Belum ada riwayat pembayaran.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                     <div class="mt-4">{{ $riwayatPembayaran->links() }}</div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>