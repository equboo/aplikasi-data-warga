<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Warga; // <-- Tambahkan ini

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Panggil seeder untuk membuat admin
        $this->call([
            AdminUserSeeder::class,
        ]);

        // Panggil WargaFactory untuk membuat 50 data warga
        Warga::factory(50)->create(); // <-- Tambahkan baris ini
    }
}