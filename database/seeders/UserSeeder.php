<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Direktur',
            'id_Kompartement' => 1,
            'id_Department' => 1,
            'id_Jabatan' => 1,
            'email' => 'superadmin@gmail.com',
            'email_verified_at' => now(),
            'role' => 'superadmin',
            'username' => 'superadmin',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Muhammad Ilham',
            'id_Kompartement' => 2,
            'id_Department' => 2,
            'id_Jabatan' => 2,
            'email' => 'ilham@gmail.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'username' => 'ilham',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Muhammad Adan',
            'id_Kompartement' => 2,
            'id_Department' => 2,
            'id_Jabatan' => 3,
            'email' => 'adan@gmail.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'username' => 'adan',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Muhammad Nanda',
            'id_Kompartement' => 2,
            'id_Department' => 2,
            'id_Jabatan' => 4,
            'email' => 'nanda@gmail.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'username' => 'nanda',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Faiz aflah',
            'id_Kompartement' => 2,
            'id_Department' => 2,
            'id_Jabatan' => 5,
            'email' => 'faiz@gmail.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'username' => 'faiz',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Fariz Aflah',
            'id_Kompartement' => 2,
            'id_Department' => 2,
            'id_Jabatan' => 6,
            'email' => 'fariz@gmail.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'username' => 'fariz',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Muhammad Arief',
            'id_Kompartement' => 3,
            'id_Department' => 3,
            'id_Jabatan' => 7,
            'email' => 'arief@gmail.com',
            'email_verified_at' => now(),
            'role' => 'coadmin',
            'username' => 'arief',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Muhammad Atila',
            'id_Kompartement' => 3,
            'id_Department' => 3,
            'id_Jabatan' => 8,
            'email' => 'atila@gmail.com',
            'email_verified_at' => now(),
            'role' => 'coadmin',
            'username' => 'atila',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'user',
            'id_Kompartement' => 3,
            'id_Department' => 3,
            'id_Jabatan' => 7,
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'role' => 'user',
            'username' => 'user',
            'password' => Hash::make('password'),
        ]);



        // User::factory(19)->create();
    }
}
