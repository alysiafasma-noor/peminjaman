<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Arya',
                'email' => 'caca1@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
            ],
            [
                'name' => 'Budi Petugas',
                'email' => 'petugas@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'petugas',
            ],
            [
                'name' => 'Rina Peminjam',
                'email' => 'peminjam1@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'peminjam',
            ],
            [
                'name' => 'Dewi Peminjam',
                'email' => 'peminjam2@gmail.com',
                'password' => bcrypt('12345678'),
                'role' => 'peminjam',
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => $user['password'],
                    'role' => $user['role'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}

