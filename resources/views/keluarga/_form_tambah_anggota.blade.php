@csrf
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    <div>
        <x-input-label for="nama_lengkap" value="Nama Lengkap" />
        <x-text-input id="nama_lengkap" class="mt-1 w-full" type="text" name="nama_lengkap" :value="old('nama_lengkap')" required />
    </div>
    <div>
        <x-input-label for="nik" value="NIK" />
        <x-text-input id="nik" class="mt-1 w-full" type="text" name="nik" :value="old('nik')" required />
    </div>
    <div>
        <x-input-label for="jenis_kelamin" value="Jenis Kelamin" />
        <select id="jenis_kelamin" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" name="jenis_kelamin" required>
            <option value="Laki-laki" @selected(old('jenis_kelamin') == 'Laki-laki')>Laki-laki</option>
            <option value="Perempuan" @selected(old('jenis_kelamin') == 'Perempuan')>Perempuan</option>
        </select>
    </div>
    <div>
        <x-input-label for="tempat_lahir" value="Tempat Lahir" />
        <x-text-input id="tempat_lahir" class="mt-1 w-full" type="text" name="tempat_lahir" :value="old('tempat_lahir')" required />
    </div>
    <div>
        <x-input-label for="tanggal_lahir" value="Tanggal Lahir" />
        <x-text-input id="tanggal_lahir" class="mt-1 w-full" type="date" name="tanggal_lahir" :value="old('tanggal_lahir')" required />
    </div>
    <div>
        <x-input-label for="agama" value="Agama" />
        <select id="agama" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" name="agama" required>
            <option value="Islam" @selected(old('agama') == 'Islam')>Islam</option>
            <option value="Kristen Protestan" @selected(old('agama') == 'Kristen Protestan')>Kristen Protestan</option>
            <option value="Kristen Katolik" @selected(old('agama') == 'Kristen Katolik')>Kristen Katolik</option>
            <option value="Hindu" @selected(old('agama') == 'Hindu')>Hindu</option>
            <option value="Buddha" @selected(old('agama') == 'Buddha')>Buddha</option>
            <option value="Khonghucu" @selected(old('agama') == 'Khonghucu')>Khonghucu</option>
        </select>
    </div>
    <div>
        <x-input-label for="pendidikan" value="Pendidikan" />
        <select id="pendidikan" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" name="pendidikan" required>
            <option @selected(old('pendidikan') == 'TIDAK/BELUM SEKOLAH')>TIDAK/BELUM SEKOLAH</option>
            <option @selected(old('pendidikan') == 'BELUM TAMAT SD/SEDERAJAT')>BELUM TAMAT SD/SEDERAJAT</option>
            <option @selected(old('pendidikan') == 'TAMAT SD/SEDERAJAT')>TAMAT SD/SEDERAJAT</option>
            <option @selected(old('pendidikan') == 'SLTP/SEDERAJAT')>SLTP/SEDERAJAT</option>
            <option @selected(old('pendidikan') == 'SLTA/SEDERAJAT')>SLTA/SEDERAJAT</option>
            <option @selected(old('pendidikan') == 'DIPLOMA I/II')>DIPLOMA I/II</option>
            <option @selected(old('pendidikan') == 'AKADEMI/DIPLOMA III/S. MUDA')>AKADEMI/DIPLOMA III/S. MUDA</option>
            <option @selected(old('pendidikan') == 'DIPLOMA IV/STRATA I')>DIPLOMA IV/STRATA I</option>
            <option @selected(old('pendidikan') == 'STRATA II')>STRATA II</option>
            <option @selected(old('pendidikan') == 'STRATA III')>STRATA III</option>
        </select>
    </div>
    <div>
        <x-input-label for="pekerjaan" value="Jenis Pekerjaan" />
        <x-text-input id="pekerjaan" class="mt-1 w-full" type="text" name="pekerjaan" :value="old('pekerjaan')" required />
    </div>
    <div>
        <x-input-label for="status_perkawinan" value="Status Perkawinan" />
        <select id="status_perkawinan" class="mt-1 w-full border-gray-300 rounded-md shadow-sm" name="status_perkawinan" required>
            <option value="Belum Kawin" @selected(old('status_perkawinan') == 'Belum Kawin')>Belum Kawin</option>
            <option value="Kawin" @selected(old('status_perkawinan') == 'Kawin')>Kawin</option>
            <option value="Cerai Hidup" @selected(old('status_perkawinan') == 'Cerai Hidup')>Cerai Hidup</option>
            <option value="Cerai Mati" @selected(old('status_perkawinan') == 'Cerai Mati')>Cerai Mati</option>
        </select>
    </div>
    <div>
        <x-input-label for="hubungan_keluarga" value="Hubungan Keluarga" />
        <x-text-input id="hubungan_keluarga" class="mt-1 w-full" type="text" name="hubungan_keluarga" :value="old('hubungan_keluarga')" required />
    </div>
    <div>
        <x-input-label for="kewarganegaraan" value="Kewarganegaraan" />
        <x-text-input id="kewarganegaraan" class="mt-1 w-full" type="text" name="kewarganegaraan" :value="old('kewarganegaraan', 'WNI')" />
    </div>
    <div>
        <x-input-label for="no_paspor" value="No Paspor" />
        <x-text-input id="no_paspor" class="mt-1 w-full" type="text" name="no_paspor" :value="old('no_paspor', '-')" placeholder="-" />
    </div>
    <div>
        <x-input-label for="no_kitas_kitap" value="No KITAS/KITAP" />
        <x-text-input id="no_kitas_kitap" class="mt-1 w-full" type="text" name="no_kitas_kitap" :value="old('no_kitas_kitap', '-')" placeholder="-" />
    </div>
    <div class="sm:col-span-2 md:col-span-3 lg:col-span-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <x-input-label for="nama_ayah" value="Nama Ayah" />
            <x-text-input id="nama_ayah" class="mt-1 w-full" type="text" name="nama_ayah" :value="old('nama_ayah')" required />
        </div>
        <div>
            <x-input-label for="nama_ibu" value="Nama Ibu" />
            <x-text-input id="nama_ibu" class="mt-1 w-full" type="text" name="nama_ibu" :value="old('nama_ibu')" required />
        </div>
    </div>
</div>

<div class="flex items-center justify-end mt-6 border-t pt-6">
    <button type="button" @click="showAddForm = false" class="text-sm text-gray-600 hover:text-gray-900 rounded-md">
        Batal
    </button>
    <x-primary-button class="ms-4">
        {{ __('Simpan Anggota Baru') }}
    </x-primary-button>
</div>