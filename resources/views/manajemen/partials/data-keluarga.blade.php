@if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
        <p>{{ session('success') }}</p>
    </div>
@endif

<div class="overflow-x-auto border rounded-lg">
    <table class="w-full bg-white">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-left w-[20%]">No. KK</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-left w-[20%]">Kepala Keluarga</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-left w-[25%]">Alamat</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-left w-[15%]">Status Rumah</th>
                <th class="py-3 px-4 uppercase font-semibold text-sm text-center w-[20%]">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-gray-700">
            @forelse ($kepalaKeluargas as $keluarga)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-3 px-4">{{ $keluarga->nomor_kk }}</td>
                <td class="py-3 px-4">{{ $keluarga->kepala_keluarga }}</td>
                <td class="py-3 px-4 text-sm">{{ $keluarga->alamat }}</td>
                <td class="py-3 px-4">{{ $keluarga->status_rumah }}</td>
                <td class="py-3 px-4 text-center whitespace-nowrap">
                    <div class="flex justify-center gap-2">
                        <a href="{{ route('keluarga.show', $keluarga->id) }}" class="text-sm bg-transparent border border-green-600 text-green-700 font-semibold px-3 py-1 rounded-md hover:bg-green-600 hover:text-white">
                            Lihat
                        </a>
                        <form action="{{ route('keluarga.destroy', $keluarga->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus seluruh keluarga ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm bg-transparent border border-red-500 text-red-500 font-semibold px-3 py-1 rounded-md hover:bg-red-500 hover:text-white">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4">Data keluarga tidak ditemukan.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $kepalaKeluargas->withQueryString()->links('pagination::tailwind') }}
</div>