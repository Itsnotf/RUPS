<?php

namespace Database\Seeders;

use App\Models\departement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        departement::create([
            'id_Kompartement' => 1,
            'nama' => 'super admin',
            'desk' => 'hanya untuk direktur'
        ]);

        departement::create([
            'id_Kompartement' => 2,
            'nama' => 'SPI',
            'desk' => 'untuk satuan pengawas intern'
        ]);

        departement::create([
            'id_Kompartement' => 3,
            'nama' => 'Operasinal internal',
            'desk' => 'untuk operasional internal'
        ]);
    }
}
