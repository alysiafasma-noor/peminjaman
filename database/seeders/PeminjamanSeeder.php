<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('peminjamen')->insert([
            [
                'id_alat' => 1,
                'id_kategori' => 1,
                'id_user' => 3,
                'tanggal_dipinjam' => now()->subDays(3),
                'tanggal_dikembalikan' => now()->subDays(1),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_alat' => 3,
                'id_kategori' => 2,
                'id_user' => 4,
                'tanggal_dipinjam' => now()->subDays(7),
                'tanggal_dikembalikan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_alat' => 8,
                'id_kategori' => 5,
                'id_user' => 3,
                'tanggal_dipinjam' => now()->subDays(10),
                'tanggal_dikembalikan' => now()->subDays(5),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
