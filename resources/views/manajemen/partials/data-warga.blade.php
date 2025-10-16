@if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p>{{ session('success') }}</p>
    </div>
@endif

<form method="GET" action="{{ route('manajemen.index') }}" class="mb-6 flex flex-col sm:flex-row gap-4 items-center">
    <div class="flex-grow w-full sm:w-auto">
        <x-input-label for="search" :value="__('Pencarian')" />
        <x-text-input id="search" class="block mt-1 w-full" type="text" name="search" placeholder="Cari Nama/NIK/No.KK/Alamat..." value="{{ request('search') }}" />
    </div>
    <div>
        <x-input-label for="jenis_kelamin" :value="__('Filter Jenis Kelamin')" />
        <select name="jenis_kelamin" id="jenis_kelamin" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="semua">Semua Jenis Kelamin</option>
            <option value="Laki-laki" @selected(request('jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
            <option value="Perempuan" @selected(request('jenis_kelamin') == 'Perempuan')>Perempuan</option>
        </select>
    </div>
    <div class="self-end flex gap-2">
        <x-primary-button class="mt-1">
            {{ __('Filter') }}
        </x-primary-button>
        <a href="{{ route('warga.download.pdf', request()->query()) }}" class="mt-1 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700">
            Download PDF
        </a>
    </div>
</form>

<div class="overflow-x-auto border rounded-lg">
    <table class="w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-left">NIK</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Nama Lengkap</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Alamat</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Status Perkawinan</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Jenis Kelamin</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @forelse ($wargas as $warga)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4">{{ $warga->nik }}</td>
                <td class="py-3 px-4">{{ $warga->nama_lengkap }}</td>
                <td class="py-3 px-4 text-sm">{{ $warga->alamat }}</td>
                <td class="py-3 px-4">{{ $warga->status_perkawinan }}</td>
                <td class="py-3 px-4">{{ $warga->jenis_kelamin }}</td>
                <td class="py-3 px-4 flex justify-center gap-2">
                    <a href="{{ route('warga.edit', $warga->id) }}" class="text-sm bg-transparent border border-blue-600 text-blue-600 px-3 py-1 rounded-md hover:bg-blue-600 hover:text-white transition-colors duration-150">Edit</a>
                    <form action="{{ route('warga.destroy', $warga->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm bg-transparent border border-red-500 text-red-500 px-3 py-1 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-150">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4">Data tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{-- Pagination untuk data warga --}}
    {{ $wargas->withQueryString()->links('pagination::tailwind') }}
</div>