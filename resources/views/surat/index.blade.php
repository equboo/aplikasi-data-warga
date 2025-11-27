<x-app-layout>
    <x-slot name="header">
        <div class="bg-white shadow-lg px-6 py-4">
            <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                {{ __('Surat Pengantar RT') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Buat Surat Baru Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    <h3 class="text-xl font-bold mb-6 text-gray-800">Buat Surat Baru</h3>
                    <form method="POST" action="{{ route('surat.generate') }}" target="_blank" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-end">
                            
                            <div x-data="{
                                    open: false,
                                    search: '',
                                    selectedWargaId: '{{ old('warga_id') }}',
                                    wargas: @js($wargas->map(fn($w) => ['id' => $w->id, 'text' => $w->nik . ' - ' . $w->nama_lengkap])),
                                    
                                    get filteredWargas() {
                                        if (this.search === '') { return this.wargas.slice(0, 10); }
                                        return this.wargas.filter(warga => {
                                            return warga.text.toLowerCase().includes(this.search.toLowerCase())
                                        }).slice(0, 10);
                                    },
                                    selectWarga(warga) {
                                        this.selectedWargaId = warga.id;
                                        this.search = warga.text;
                                        this.open = false;
                                    }
                                 }" x-on:click.outside="open = false" class="relative">

                                <x-input-label for="warga_search" :value="__('Surat Ini Dibuat Untuk (Ketik untuk mencari)')" class="text-sm font-medium text-gray-700" />
                                <x-text-input id="warga_search" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" type="text" x-model="search" @focus="open = true" @input.debounce.300ms="open = true" autocomplete="off" placeholder="Ketik NIK atau Nama Warga..." />
                                <input type="hidden" name="warga_id" x-model="selectedWargaId">

                                <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute z-10 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg max-h-60 overflow-y-auto" style="display: none;">
                                    <template x-for="warga in filteredWargas" :key="warga.id">
                                        <button type="button" @click="selectWarga(warga)" class="w-full text-left px-4 py-3 hover:bg-blue-50 focus:outline-none focus:bg-blue-50 transition-colors duration-150">
                                            <span x-text="warga.text" class="text-gray-800"></span>
                                        </button>
                                    </template>
                                    <div x-show="filteredWargas.length === 0" class="px-4 py-3 text-gray-500">
                                        Tidak ada warga yang cocok.
                                    </div>
                                </div>
                            </div>

                            <div>
                                <x-input-label for="keperluan" :value="__('Pilih Keperluan Surat')" class="text-sm font-medium text-gray-700" />
                                <select id="keperluan" name="keperluan" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all duration-200" required>
                                    <option value="">-- Pilih salah satu keperluan --</option>
                                    @foreach ($keperluanList as $item)
                                        <option value="{{ $item }}" @selected(old('keperluan') == $item)>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-8">
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 transition-all duration-200">
                                {{ __('Cetak Surat') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Riwayat Surat Section -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    <h3 class="text-xl font-bold mb-6 text-gray-800">Riwayat Surat</h3>
                    
                    <form method="GET" action="{{ route('surat.index') }}" class="mb-8 flex flex-col sm:flex-row gap-6 items-end bg-gradient-to-r from-gray-50 to-white p-6 rounded-lg shadow-sm border border-gray-200">
                        <input type="hidden" name="tab" value="laporan">
                        <div class="flex-grow">
                            <x-input-label for="bulan" :value="__('Filter Bulan')" class="text-sm font-medium text-gray-700" />
                            <select name="bulan" id="bulan" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                <option value="semua">Semua Bulan</option>
                                @foreach ($months as $num => $name)
                                    <option value="{{ $num + 1 }}" @selected(request('bulan') == $num + 1)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-grow">
                            <x-input-label for="tahun" :value="__('Filter Tahun')" class="text-sm font-medium text-gray-700" />
                            <select name="tahun" id="tahun" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                                <option value="semua">Semua Tahun</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" @selected(request('tahun') == $year)>{{ $year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="self-end flex gap-3">
                            <x-primary-button class="bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 transition-all duration-200">
                                {{ __('Filter') }}
                            </x-primary-button>
                            <a href="{{ route('surat.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-sm text-white uppercase tracking-widest hover:bg-gray-700 focus:ring-gray-500 transition-all duration-200">
                                Reset
                            </a>
                        </div>
                    </form>
                    
                    @if (session('success'))
                        <div class="bg-green-50 border-l-4 border-green-400 text-green-800 p-4 mb-6 rounded-lg shadow-sm" role="alert">
                            <p class="font-medium">{{ session('success') }}</p>
                        </div>
                    @endif
                    
                    <div class="overflow-x-auto border border-gray-200 rounded-lg shadow-sm">
                        <table class="w-full bg-white divide-y divide-gray-200">
                            <thead class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
                                <tr>
                                    <th class="py-4 px-6 text-left text-xs font-semibold uppercase tracking-wider">No. Surat</th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold uppercase tracking-wider">Tanggal</th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold uppercase tracking-wider">Nama Warga</th>
                                    <th class="py-4 px-6 text-left text-xs font-semibold uppercase tracking-wider">Keperluan</th>
                                    <th class="py-4 px-6 text-center text-xs font-semibold uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700 divide-y divide-gray-200">
                                @forelse ($riwayats as $riwayat)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="py-4 px-6 text-sm font-mono text-gray-900">{{ $riwayat->nomor_surat }}</td>
                                    <td class="py-4 px-6 text-sm whitespace-nowrap text-gray-900">{{ $riwayat->created_at->format('d M Y') }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-900">{{ $riwayat->warga->nama_lengkap ?? 'Warga Dihapus' }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-900">{{ $riwayat->keperluan }}</td>
                                    <td class="py-4 px-6 text-center">
                                        <form action="{{ route('surat.destroy', $riwayat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat surat ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 focus:ring-red-500 transition-all duration-200 shadow-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-8 text-gray-500">Tidak ada riwayat surat yang cocok dengan filter.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $riwayats->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>