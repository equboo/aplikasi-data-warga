<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Surat Pengantar RT') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Buat Surat Baru</h3>
                    <form method="POST" action="{{ route('surat.generate') }}" target="_blank">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <x-input-label for="warga_id" :value="__('Surat Ini Dibuat Untuk')" />
                                <select id="warga_id" name="warga_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih salah satu warga --</option>
                                    @foreach ($wargas as $warga)
                                        <option value="{{ $warga->id }}" @selected(old('warga_id') == $warga->id)>
                                            {{ $warga->nik }} - {{ $warga->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <x-input-label for="keperluan" :value="__('Pilih Keperluan Surat')" />
                                <select id="keperluan" name="keperluan" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                                    <option value="">-- Pilih salah satu keperluan --</option>
                                    @foreach ($keperluanList as $item)
                                        <option value="{{ $item }}" @selected(old('keperluan') == $item)>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button>
                                {{ __('Cetak Surat') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Riwayat Surat</h3>
                    
                    <form method="GET" action="{{ route('surat.index') }}" class="mb-6 flex flex-col sm:flex-row gap-4 items-center bg-gray-50 p-4 rounded-lg">
                        <div class="flex-grow">
                            <x-input-label for="bulan" :value="__('Filter Bulan')" />
                            <select name="bulan" id="bulan" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="semua">Semua Bulan</option>
                                @foreach ($months as $num => $name)
                                    <option value="{{ $num }}" @selected(request('bulan') == $num)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-grow">
                            <x-input-label for="tahun" :value="__('Filter Tahun')" />
                            <select name="tahun" id="tahun" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                <option value="semua">Semua Tahun</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" @selected(request('tahun') == $year)>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="self-end flex gap-2">
                            <x-primary-button class="mt-1">
                                {{ __('Filter') }}
                            </x-primary-button>
                            <a href="{{ route('surat.index') }}" class="mt-1 inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                Reset
                            </a>
                        </div>
                    </form>
                    
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    <div class="overflow-x-auto border rounded-lg">
                        <table class="w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">No. Surat</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Tanggal</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Nama Warga</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Keperluan</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @forelse ($riwayats as $riwayat)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4 font-mono">{{ $riwayat->nomor_surat }}</td>
                                    <td class="py-3 px-4 whitespace-nowrap">{{ $riwayat->created_at->format('d M Y') }}</td>
                                    <td class="py-3 px-4">{{ $riwayat->warga->nama_lengkap ?? 'Warga Dihapus' }}</td>
                                    <td class="py-3 px-4">{{ $riwayat->keperluan }}</td>
                                    <td class="py-3 px-4 text-center">
                                        <form action="{{ route('surat.destroy', $riwayat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat surat ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm bg-transparent border border-red-500 text-red-500 px-3 py-1 rounded-md hover:bg-red-500 hover:text-white transition-colors">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">Tidak ada riwayat surat yang cocok dengan filter.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $riwayats->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>