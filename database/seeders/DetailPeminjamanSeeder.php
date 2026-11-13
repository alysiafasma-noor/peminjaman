<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailPeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_peminjamen')->insert([
            [
                'id_peminjaman' => 1,
                'id_alat' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_peminjaman' => 2,
                'id_alat' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_peminjaman' => 3,
                'id_alat' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
