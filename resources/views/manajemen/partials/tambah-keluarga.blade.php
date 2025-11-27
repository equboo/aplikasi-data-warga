@if ($errors->any())
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
        <p class="font-bold">Terjadi Kesalahan</p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('keluarga.store') }}" x-data="{ 
    members: @js(old('members', [['nik' => '', 'nama_lengkap' => '', 'hubungan_keluarga' => 'Kepala Keluarga', 'jenis_kelamin' => 'Laki-laki', 'tempat_lahir' => '', 'tanggal_lahir' => '', 'agama' => 'Islam', 'pendidikan' => 'TIDAK/BELUM SEKOLAH', 'status_perkawinan' => 'Kawin', 'pekerjaan' => '', 'kewarganegaraan' => 'WNI', 'no_paspor' => '-', 'no_kitas_kitap' => '-', 'nama_ayah' => '', 'nama_ibu' => '']])),
    addMember() {
        this.members.push({ nik: '', nama_lengkap: '', hubungan_keluarga: 'Anak', jenis_kelamin: 'Laki-laki', tempat_lahir: '', tanggal_lahir: '', agama: 'Islam', pendidikan: 'TIDAK/BELUM SEKOLAH', status_perkawinan: 'Belum Kawin', pekerjaan: '', kewarganegaraan: 'WNI', 'no_paspor': '-', 'no_kitas_kitap': '-', 'nama_ayah': '', 'nama_ibu': '' });
    }
}">
    @csrf
    <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Data Keluarga</h3>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="md:col-span-2">
            <x-input-label for="nomor_kk" :value="__('Nomor Kartu Keluarga (KK)')" />
            <x-text-input id="nomor_kk" class="block mt-1 w-full" type="text" name="nomor_kk" :value="old('nomor_kk')" required />
        </div>
        <div class="md:col-span-2">
            <x-input-label for="status_rumah" :value="__('Status Kepemilikan Rumah')" />
            <select id="status_rumah" name="status_rumah" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="Milik Sendiri" @selected(old('status_rumah') == 'Milik Sendiri')>Milik Sendiri</option>
                <option value="Sewa/Kontrak" @selected(old('status_rumah') == 'Sewa/Kontrak')>Sewa/Kontrak</option>
                <option value="Numpang" @selected(old('status_rumah') == 'Numpang')>Numpang</option>
            </select>
        </div>
        <div class="md:col-span-4">
            <x-input-label for="alamat" :value="__('Alamat')" />
            <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat')" required />
        </div>
        <div>
            <x-input-label for="rt" :value="__('RT')" />
            <x-text-input id="rt" class="block mt-1 w-full" type="text" name="rt" :value="old('rt', '006')" required />
        </div>
        <div>
            <x-input-label for="rw" :value="__('RW')" />
            <x-text-input id="rw" class="block mt-1 w-full" type="text" name="rw" :value="old('rw', '007')" required />
        </div>
        <div class="md:col-span-2">
            <x-input-label for="desa_kelurahan" :value="__('Desa/Kelurahan')" />
            <x-text-input id="desa_kelurahan" class="block mt-1 w-full" type="text" name="desa_kelurahan" :value="old('desa_kelurahan', 'Mustikajaya')" required />
        </div>
        <div>
            <x-input-label for="kecamatan" :value="__('Kecamatan')" />
            <x-text-input id="kecamatan" class="block mt-1 w-full" type="text" name="kecamatan" :value="old('kecamatan', 'Mustikajaya')" required />
        </div>
        <div>
            <x-input-label for="kabupaten_kota" :value="__('Kabupaten/Kota')" />
            <x-text-input id="kabupaten_kota" class="block mt-1 w-full" type="text" name="kabupaten_kota" :value="old('kabupaten_kota', 'Kota Bekasi')" required />
        </div>
        <div>
            <x-input-label for="kode_pos" :value="__('Kode Pos')" />
            <x-text-input id="kode_pos" class="block mt-1 w-full" type="text" name="kode_pos" :value="old('kode_pos', '17156')" required />
        </div>
        <div>
            <x-input-label for="provinsi" :value="__('Provinsi')" />
            <x-text-input id="provinsi" class="block mt-1 w-full" type="text" name="provinsi" :value="old('provinsi', 'Jawa Barat')" required />
        </div>
    </div>

    <h3 class="text-lg font-bold text-gray-900 mb-4 mt-8 border-b pb-2">Daftar Anggota Keluarga</h3>
    <template x-for="(member, index) in members" :key="index">
        <div class="p-4 mb-4 border rounded-lg bg-gray-50">
            <div class="flex justify-between items-center mb-4">
                <h4 class="font-bold text-gray-800" x-text="`Anggota ke-${index + 1}`"></h4>
                <button type="button" x-show="index > 0" @click="members.splice(index, 1)" class="text-sm text-red-500 hover:text-red-700 font-semibold">
                    Hapus
                </button>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <div>
                    <x-input-label x-bind:for="`nama_${index}`" value="Nama Lengkap" />
                    <x-text-input x-bind:id="`nama_${index}`" class="mt-1 w-full" type="text" x-bind:name="`members[${index}][nama_lengkap]`" x-model="member.nama_lengkap" required />
                </div>
                <div>
                    <x-input-label x-bind:for="`nik_${index}`" value="NIK" />
                    <x-text-input x-bind:id="`nik_${index}`" class="mt-1 w-full" type="text" x-bind:name="`members[${index}][nik]`" x-model="member.nik" required />
                </div>
                <div>
                    <x-input-label x-bind:for="`jk_${index}`" value="Jenis Kelamin" />
                    <select x-bind:id="`jk_${index}`" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" x-bind:name="`members[${index}][jenis_kelamin]`" x-model="member.jenis_kelamin">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <x-input-label x-bind:for="`tempat_${index}`" value="Tempat Lahir" />
                    <x-text-input x-bind:id="`tempat_${index}`" class="mt-1 w-full" type="text" x-bind:name="`members[${index}][tempat_lahir]`" x-model="member.tempat_lahir" required />
                </div>
                <div>
                    <x-input-label x-bind:for="`tgl_${index}`" value="Tanggal Lahir" />
                    <x-text-input x-bind:id="`tgl_${index}`" class="mt-1 w-full" type="date" x-bind:name="`members[${index}][tanggal_lahir]`" x-model="member.tanggal_lahir" required />
                </div>
                <div>
                    <x-input-label x-bind:for="`agama_${index}`" value="Agama" />
                    <select x-bind:id="`agama_${index}`" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" x-bind:name="`members[${index}][agama]`" x-model="member.agama">
                        <option value="Islam">Islam</option>
                        <option value="Kristen Protestan">Kristen Protestan</option>
                        <option value="Kristen Katolik">Kristen Katolik</option>
                        <option value="Hindu">Hindu</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Khonghucu">Khonghucu</option>
                    </select>
                </div>
                <div>
                    <x-input-label x-bind:for="`pendidikan_${index}`" value="Pendidikan" />
                    <select x-bind:id="`pendidikan_${index}`" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" x-bind:name="`members[${index}][pendidikan]`" x-model="member.pendidikan">
                        <option>TIDAK/BELUM SEKOLAH</option>
                        <option>BELUM TAMAT SD/SEDERAJAT</option>
                        <option>TAMAT SD/SEDERAJAT</option>
                        <option>SLTP/SEDERAJAT</option>
                        <option>SLTA/SEDERAJAT</option>
                        <option>DIPLOMA I/II</option>
                        <option>AKADEMI/DIPLOMA III/S. MUDA</option>
                        <option>DIPLOMA IV/STRATA I</option>
                        <option>STRATA II</option>
                        <option>STRATA III</option>
                    </select>
                </div>
                <div>
                    <x-input-label x-bind:for="`pekerjaan_${index}`" value="Jenis Pekerjaan" />
                    <x-text-input x-bind:id="`pekerjaan_${index}`" class="mt-1 w-full" type="text" x-bind:name="`members[${index}][pekerjaan]`" x-model="member.pekerjaan" required />
                </div>
                <div>
                    <x-input-label x-bind:for="`kawin_${index}`" value="Status Perkawinan" />
                    <select x-bind:id="`kawin_${index}`" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" x-bind:name="`members[${index}][status_perkawinan]`" x-model="member.status_perkawinan">
                        <option>Belum Kawin</option>
                        <option>Kawin</option>
                        <option>Cerai Hidup</option>
                        <option>Cerai Mati</option>
                    </select>
                </div>
                <div>
                    <x-input-label x-bind:for="`hubungan_${index}`" value="Hubungan Keluarga" />
                    <x-text-input x-bind:id="`hubungan_${index}`" class="mt-1 w-full" type="text" x-bind:name="`members[${index}][hubungan_keluarga]`" x-model="member.hubungan_keluarga" required />
                </div>
                <div>
                    <x-input-label x-bind:for="`kwn_${index}`" value="Kewarganegaraan" />
                    <x-text-input x-bind:id="`kwn_${index}`" class="mt-1 w-full" type="text" x-bind:name="`members[${index}][kewarganegaraan]`" x-model="member.kewarganegaraan" />
                </div>
                <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <x-input-label x-bind:for="`ayah_${index}`" value="Nama Ayah" />
                        <x-text-input x-bind:id="`ayah_${index}`" class="mt-1 w-full" type="text" x-bind:name="`members[${index}][nama_ayah]`" x-model="member.nama_ayah" required />
                    </div>
                    <div>
                        <x-input-label x-bind:for="`ibu_${index}`" value="Nama Ibu" />
                        <x-text-input x-bind:id="`ibu_${index}`" class="mt-1 w-full" type="text" x-bind:name="`members[${index}][nama_ibu]`" x-model="member.nama_ibu" required />
                    </div>
                </div>
            </div>
        </div>
    </template>

    <button type="button" @click="addMember()" class="mt-2 text-sm bg-green-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-green-700 transition-colors duration-150">
        + Tambah Anggota Lain
    </button>
    
    <div class="flex items-center justify-end mt-8">
        <a href="{{ route('manajemen.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
        <x-primary-button class="ms-4">
            Simpan Data Keluarga
        </x-primary-button>
    </div>
</form>