<?php

namespace Database\Seeders;

use App\Models\kompartement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KompartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        kompartement::create([
            'nama' => 'super admin',
            'desk' => 'Hanya untuk direktur',
        ]);

        kompartement::create([
            'nama' => 'SPI',
            'desk' => 'Untuk para Satuan pengawasan intern',
        ]);

        kompartement::create([
            'nama' => 'Operasi',
            'desk' => 'Hanya untuk operasional',
        ]);
    }
}
