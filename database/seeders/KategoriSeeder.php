<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('kategoris')->insert([
            [
                'nama_kategori' => 'Jaringan Komputer',
                'deskripsi' => 'Alat praktik jaringan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Multimedia',
                'deskripsi' => 'Kamera dan audio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
