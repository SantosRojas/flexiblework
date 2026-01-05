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
            'name' => 'Santos Rojas',
            'email' => 'rojas@example.com',
            'password' => bcrypt('santos123'),
            'role' => 'admin',
            'work_area' => 'IT',

        ]);
        User::create([
            'name' => 'Maria Gomez',
            'email' => 'maria@mail.com',
            'password' => bcrypt('maria123'),
            'role' => 'manager',
            'work_area' => 'HR'
        ]);

        User::create([
            'name' => 'Luis Fernandez',
            'email' => 'luis@mail.com',
            'password' => bcrypt('luis123'),
            'role' => 'user',
            'work_area' => 'HR'
        ]);

        User::create([
            'name' => 'Ana Martinez',
            'email' => 'ana@mail.com',
            'password' => bcrypt('ana123'),
            'role' => 'user',
            'work_area' => 'Finance'
        ]);

        User::create([
            'name' => 'Carlos Lopez',
            'email' => 'carlos@mail.com',
            'password' => bcrypt('carlos123'),
            'role' => 'user',
            'work_area' => 'HR'
        ]);

        User::create([
            'name' => 'Sofia Ramirez',
            'email' => 'sofia@mail.com',
            'password' => bcrypt('sofia123'),
            'role' => 'manager',
            'work_area' => 'Finance'
        ]);


    }
}
