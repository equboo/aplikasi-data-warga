@csrf
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

<h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Data Keluarga & Alamat</h3>
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="md:col-span-2">
        <x-input-label for="nomor_kk" :value="__('Nomor Kartu Keluarga (KK)')" />
        <x-text-input id="nomor_kk" class="block mt-1 w-full" type="text" name="nomor_kk" :value="old('nomor_kk', $warga->nomor_kk)" required />
    </div>
    <div class="md:col-span-2">
        <x-input-label for="kepala_keluarga" :value="__('Nama Kepala Keluarga')" />
        <x-text-input id="kepala_keluarga" class="block mt-1 w-full" type="text" name="kepala_keluarga" :value="old('kepala_keluarga', $warga->kepala_keluarga)" required />
    </div>
    <div class="md:col-span-4">
        <x-input-label for="alamat" :value="__('Alamat')" />
        <x-text-input id="alamat" class="block mt-1 w-full" type="text" name="alamat" :value="old('alamat', $warga->alamat)" required />
    </div>
    <div>
        <x-input-label for="rt" :value="__('RT')" />
        <x-text-input id="rt" class="block mt-1 w-full" type="text" name="rt" :value="old('rt', $warga->rt)" required />
    </div>
    <div>
        <x-input-label for="rw" :value="__('RW')" />
        <x-text-input id="rw" class="block mt-1 w-full" type="text" name="rw" :value="old('rw', $warga->rw)" required />
    </div>
    <div class="md:col-span-2">
        <x-input-label for="desa_kelurahan" :value="__('Desa/Kelurahan')" />
        <x-text-input id="desa_kelurahan" class="block mt-1 w-full" type="text" name="desa_kelurahan" :value="old('desa_kelurahan', $warga->desa_kelurahan)" required />
    </div>
    <div>
        <x-input-label for="kecamatan" :value="__('Kecamatan')" />
        <x-text-input id="kecamatan" class="block mt-1 w-full" type="text" name="kecamatan" :value="old('kecamatan', $warga->kecamatan)" required />
    </div>
    <div>
        <x-input-label for="kabupaten_kota" :value="__('Kabupaten/Kota')" />
        <x-text-input id="kabupaten_kota" class="block mt-1 w-full" type="text" name="kabupaten_kota" :value="old('kabupaten_kota', $warga->kabupaten_kota)" required />
    </div>
    <div>
        <x-input-label for="kode_pos" :value="__('Kode Pos')" />
        <x-text-input id="kode_pos" class="block mt-1 w-full" type="text" name="kode_pos" :value="old('kode_pos', $warga->kode_pos)" required />
    </div>
    <div>
        <x-input-label for="provinsi" :value="__('Provinsi')" />
        <x-text-input id="provinsi" class="block mt-1 w-full" type="text" name="provinsi" :value="old('provinsi', $warga->provinsi)" required />
    </div>
    <div>
        <x-input-label for="status_rumah" :value="__('Status Kepemilikan Rumah')" />
        <select id="status_rumah" name="status_rumah" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm" required>
            <option value="Milik Sendiri" @selected(old('status_rumah', $warga->status_rumah) == 'Milik Sendiri')>Milik Sendiri</option>
            <option value="Sewa/Kontrak" @selected(old('status_rumah', $warga->status_rumah) == 'Sewa/Kontrak')>Sewa/Kontrak</option>
            <option value="Numpang" @selected(old('status_rumah', $warga->status_rumah) == 'Numpang')>Numpang</option>
        </select>
    </div>
</div>

<h3 class="text-lg font-bold text-gray-900 mb-4 mt-8 border-b pb-2">Data Individu Warga</h3>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <div>
        <x-input-label for="nama_lengkap" value="Nama Lengkap" />
        <x-text-input id="nama_lengkap" class="mt-1 w-full" type="text" name="nama_lengkap" :value="old('nama_lengkap', $warga->nama_lengkap)" required />
    </div>
    <div>
        <x-input-label for="nik" value="NIK" />
        <x-text-input id="nik" class="mt-1 w-full" type="text" name="nik" :value="old('nik', $warga->nik)" required />
    </div>
    <div>
        <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
        <select id="jenis_kelamin" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" name="jenis_kelamin" required>
            <option value="Laki-laki" @selected(old('jenis_kelamin', $warga->jenis_kelamin) == 'Laki-laki')>Laki-laki</option>
            <option value="Perempuan" @selected(old('jenis_kelamin', $warga->jenis_kelamin) == 'Perempuan')>Perempuan</option>
        </select>
    </div>
    <div>
        <x-input-label for="tempat_lahir" value="Tempat Lahir" />
        <x-text-input id="tempat_lahir" class="mt-1 w-full" type="text" name="tempat_lahir" :value="old('tempat_lahir', $warga->tempat_lahir)" required />
    </div>
    <div>
        <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
        <x-text-input id="tanggal_lahir" class="mt-1 w-full" type="date" name="tanggal_lahir" :value="old('tanggal_lahir', $warga->tanggal_lahir)" required />
    </div>
    <div>
        <x-input-label for="agama" value="Agama" />
        <select id="agama" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" name="agama" required>
            <option value="Islam" @selected(old('agama', $warga->agama) == 'Islam')>Islam</option>
            <option value="Kristen Protestan" @selected(old('agama', $warga->agama) == 'Kristen Protestan')>Kristen Protestan</option>
            <option value="Kristen Katolik" @selected(old('agama', $warga->agama) == 'Kristen Katolik')>Kristen Katolik</option>
            <option value="Hindu" @selected(old('agama', $warga->agama) == 'Hindu')>Hindu</option>
            <option value="Buddha" @selected(old('agama', $warga->agama) == 'Buddha')>Buddha</option>
            <option value="Khonghucu" @selected(old('agama', $warga->agama) == 'Khonghucu')>Khonghucu</option>
        </select>
    </div>
    <div>
        <x-input-label for="pendidikan" value="Pendidikan" />
        <select id="pendidikan" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" name="pendidikan" required>
            <option @selected(old('pendidikan', $warga->pendidikan) == 'TIDAK/BELUM SEKOLAH')>TIDAK/BELUM SEKOLAH</option>
            <option @selected(old('pendidikan', $warga->pendidikan) == 'BELUM TAMAT SD/SEDERAJAT')>BELUM TAMAT SD/SEDERAJAT</option>
            <option @selected(old('pendidikan', $warga->pendidikan) == 'TAMAT SD/SEDERAJAT')>TAMAT SD/SEDERAJAT</option>
            <option @selected(old('pendidikan', $warga->pendidikan) == 'SLTP/SEDERAJAT')>SLTP/SEDERAJAT</option>
            <option @selected(old('pendidikan', $warga->pendidikan) == 'SLTA/SEDERAJAT')>SLTA/SEDERAJAT</option>
            <option @selected(old('pendidikan', $warga->pendidikan) == 'DIPLOMA I/II')>DIPLOMA I/II</option>
            <option @selected(old('pendidikan', $warga->pendidikan) == 'AKADEMI/DIPLOMA III/S. MUDA')>AKADEMI/DIPLOMA III/S. MUDA</option>
            <option @selected(old('pendidikan', $warga->pendidikan) == 'DIPLOMA IV/STRATA I')>DIPLOMA IV/STRATA I</option>
            <option @selected(old('pendidikan', $warga->pendidikan) == 'STRATA II')>STRATA II</option>
            <option @selected(old('pendidikan', $warga->pendidikan) == 'STRATA III')>STRATA III</option>
        </select>
    </div>
    <div>
        <x-input-label for="pekerjaan" value="Jenis Pekerjaan" />
        <x-text-input id="pekerjaan" class="mt-1 w-full" type="text" name="pekerjaan" :value="old('pekerjaan', $warga->pekerjaan)" required />
    </div>
    <div>
        <x-input-label for="status_perkawinan" value="Status Perkawinan" />
        <select id="status_perkawinan" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" name="status_perkawinan" required>
            <option value="Belum Kawin" @selected(old('status_perkawinan', $warga->status_perkawinan) == 'Belum Kawin')>Belum Kawin</option>
            <option value="Kawin" @selected(old('status_perkawinan', $warga->status_perkawinan) == 'Kawin')>Kawin</option>
            <option value="Cerai Hidup" @selected(old('status_perkawinan', $warga->status_perkawinan) == 'Cerai Hidup')>Cerai Hidup</option>
            <option value="Cerai Mati" @selected(old('status_perkawinan', $warga->status_perkawinan) == 'Cerai Mati')>Cerai Mati</option>
        </select>
    </div>
    <div>
        <x-input-label for="hubungan_keluarga" value="Hubungan Keluarga" />
        <x-text-input id="hubungan_keluarga" class="mt-1 w-full" type="text" name="hubungan_keluarga" :value="old('hubungan_keluarga', $warga->hubungan_keluarga)" required />
    </div>
    <div>
        <x-input-label for="kewarganegaraan" value="Kewarganegaraan" />
        <x-text-input id="kewarganegaraan" class="mt-1 w-full" type="text" name="kewarganegaraan" :value="old('kewarganegaraan', $warga->kewarganegaraan)" />
    </div>
    <div>
        <x-input-label for="no_paspor" value="No Paspor" />
        <x-text-input id="no_paspor" class="mt-1 w-full" type="text" name="no_paspor" :value="old('no_paspor', $warga->no_paspor)" placeholder="-" />
    </div>
    <div>
        <x-input-label for="no_kitas_kitap" value="No KITAS/KITAP" />
        <x-text-input id="no_kitas_kitap" class="mt-1 w-full" type="text" name="no_kitas_kitap" :value="old('no_kitas_kitap', $warga->no_kitas_kitap)" placeholder="-" />
    </div>
    <div class="lg:col-span-3 grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <x-input-label for="nama_ayah" value="Nama Ayah" />
            <x-text-input id="nama_ayah" class="mt-1 w-full" type="text" name="nama_ayah" :value="old('nama_ayah', $warga->nama_ayah)" required />
        </div>
        <div>
            <x-input-label for="nama_ibu" value="Nama Ibu" />
            <x-text-input id="nama_ibu" class="mt-1 w-full" type="text" name="nama_ibu" :value="old('nama_ibu', $warga->nama_ibu)" required />
        </div>
    </div>
</div>

<div class="flex items-center justify-end mt-8 border-t pt-6">
    <a href="{{ route('warga.index') }}" class="text-sm text-gray-600 hover:text-gray-900 rounded-md">
        Batal
    </a>
    <x-primary-button class="ms-4">
        {{ __('Simpan Perubahan') }}
    </x-primary-button>
</div>