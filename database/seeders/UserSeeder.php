<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'Admin Lab',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Petugas Alat',
                'username' => 'petugas',
                'password' => Hash::make('petugas123'),
                'role' => 'petugas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Arief Siswa',
                'username' => 'peminjam',
                'password' => Hash::make('peminjam123'),
                'role' => 'peminjam',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
