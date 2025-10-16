<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WargaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nomor_kk' => fake()->unique()->numerify('################'),
            'kepala_keluarga' => fake()->name('male'),
            'alamat' => fake()->streetAddress(),
            'rt' => '006',
            'rw' => '007',
            'desa_kelurahan' => 'Mustikajaya',
            'kecamatan' => 'Mustikajaya',
            'kabupaten_kota' => 'Kota Bekasi',
            'kode_pos' => '17155',
            'provinsi' => 'Jawa Barat',
            'nik' => fake()->unique()->numerify('################'),
            'nama_lengkap' => fake()->name(),
            'jenis_kelamin' => fake()->randomElement(['Laki-laki', 'Perempuan']),
            'tempat_lahir' => fake()->city(),
            'tanggal_lahir' => fake()->date(),
            'agama' => fake()->randomElement(['Islam', 'Kristen Protestan', 'Kristen Katolik', 'Hindu', 'Buddha', 'Khonghucu']),
            'pendidikan' => fake()->randomElement(['SD/SEDERAJAT', 'SLTP/SEDERAJAT', 'SLTA/SEDERAJAT', 'DIPLOMA IV/STRATA I']),
            'pekerjaan' => fake()->jobTitle(),
            'status_perkawinan' => fake()->randomElement(['Kawin', 'Belum Kawin']),
            'hubungan_keluarga' => fake()->randomElement(['Anak', 'Istri']),
            'kewarganegaraan' => 'WNI',
            'no_paspor' => '-',
            'no_kitas_kitap' => '-',
            'nama_ayah' => fake()->name('male'),
            'nama_ibu' => fake()->name('female'),
        ];
    }
}