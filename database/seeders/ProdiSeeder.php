<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Prodi;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Prodi::create(['nama_prodi' => 'Manajemen']);
        Prodi::create(['nama_prodi' => 'Akuntansi']);
        Prodi::create(['nama_prodi' => 'Teknik Informatika']);
    }
}
