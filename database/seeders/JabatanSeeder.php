<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jabatan::create([
            'nama' => 'Direktur',
            'desk' => 'Direktur Utama',
        ]);

        Jabatan::create([
            'nama' => 'Staff Monitoring Eval',
            'desk' => 'Hanya Untuk SPI',
        ]);
        Jabatan::create([
            'nama' => 'Senior Auditor',
            'desk' => 'Hanya Untuk SPI',
        ]);
        Jabatan::create([
            'nama' => 'Pengendalian Teknis',
            'desk' => 'Hanya Untuk SPI',
        ]);

        Jabatan::create([
            'nama' => 'Vice President',
            'desk' => 'Untuk VP',
        ]);

        Jabatan::create([
            'nama' => 'Super Vice President',
            'desk' => 'Untuk SVP',
        ]);

        Jabatan::create([
            'nama' => 'Vice President Department',
            'desk' => 'Untuk VP',
        ]);

        Jabatan::create([
            'nama' => 'Super Vice President Department',
            'desk' => 'Untuk SVP',
        ]);

        Jabatan::create([
            'nama' => 'Staff PIC',
            'desk' => 'Hanya Untuk User',
        ]);
    }
}
