<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alats')->insert([
            [
                'nama_alat' => 'Laptop Lenovo ThinkPad',
                'id_kategori' => 1,
                'stok' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_alat' => 'Laptop Asus VivoBook',
                'id_kategori' => 1,
                'stok' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_alat' => 'Projector Epson EB-X06',
                'id_kategori' => 2,
                'stok' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_alat' => 'Smart TV 55 inch',
                'id_kategori' => 2,
                'stok' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_alat' => 'Mic Wireless Shure',
                'id_kategori' => 2,
                'stok' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_alat' => 'Oscilloscope Digital',
                'id_kategori' => 3,
                'stok' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_alat' => 'Multimeter',
                'id_kategori' => 3,
                'stok' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_alat' => 'Router Cisco',
                'id_kategori' => 5,
                'stok' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_alat' => 'Switch Hub 24 Port',
                'id_kategori' => 5,
                'stok' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_alat' => 'Kabel HDMI 10m',
                'id_kategori' => 4,
                'stok' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
