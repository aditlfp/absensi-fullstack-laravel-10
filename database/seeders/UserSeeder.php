<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'nama_lengkap' => 'Super Admin',
            'role_id' => '2',
            'kerjasama_id' => '1', 
            'devisi_id' => '1',
            'email' => 'test.admin@example.com',
            'password' => '$2y$10$XjXCLOdE8qYiX4Di1GAmbe.m66xh3uWNip6r.gJsdZQDK6nvyUAoK',
            'image' => 'no-image.jpg'
        ]);
        
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'nama_lengkap' => 'admin',
            'role_id' => '2',
            'kerjasama_id' => '1',
            'devisi_id' => '1',
            'email' => 'admin@example.com',
            'password' => '$2y$10$XjXCLOdE8qYiX4Di1GAmbe.m66xh3uWNip6r.gJsdZQDK6nvyUAoK',
            'image' => 'no-image.jpg'

        ]);
        \App\Models\User::factory()->create([
            'name' => 'spv',
            'nama_lengkap' => 'spv',
            'role_id' => '1',
            'kerjasama_id' => '1',
            'devisi_id' => '3',
            'email' => 'spv@example.com',
            'password' => '$2y$10$XjXCLOdE8qYiX4Di1GAmbe.m66xh3uWNip6r.gJsdZQDK6nvyUAoK',
            'image' => 'no-image.jpg'

        ]);
        
        \App\Models\User::factory()->create([
            'name' => 'User',
            'nama_lengkap' => 'user',
            'role_id' => '1',
            'kerjasama_id' => '1',
            'devisi_id' => '1',
            'email' => 'test@example.com',
            'password' => '$2y$10$XjXCLOdE8qYiX4Di1GAmbe.m66xh3uWNip6r.gJsdZQDK6nvyUAoK',
            'image' => 'no-image.jpg'

        ]);

    }
}
