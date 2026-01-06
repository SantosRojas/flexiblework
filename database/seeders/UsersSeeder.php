<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Jose Perez',
            'email' => 'jose.perez@example.com',
            'password' => bcrypt('jose123'),
            'role' => 'user',
            'work_area' => 'IT',

        ]);
        User::create([
            'name' => 'Mario Gomez',
            'email' => 'mario.gomez@example.com',
            'password' => bcrypt('mario123'),
            'role' => 'user',
            'work_area' => 'HR'
        ]);

        User::create([
            'name' => 'Luis Guzman',
            'email' => 'luis.guzman@example.com',
            'password' => bcrypt('luis123'),
            'role' => 'user',
            'work_area' => 'HR'
        ]);

        User::create([
            'name' => 'Rosa Martinez',
            'email' => 'rosa.martinez@example.com',
            'password' => bcrypt('rosa123'),
            'role' => 'user',
            'work_area' => 'Finance'
        ]);

        User::create([
            'name' => 'Miguel Lopez',
            'email' => 'miguel.lopez@example.com',
            'password' => bcrypt('miguel123'),
            'role' => 'user',
            'work_area' => 'HR'
        ]);

    }
}
