<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Client::factory()->create([
            'name' => 'client 1',
            'address' => 'ponorogo',
            'province' => 'ponorogo',
            'kabupaten' => 'ponorogo',
            'zipcode' => '987789',
            'email' => 'client1@gmail.com',
            'phone' => '0980977686798',
            'fax' => '08789723',
            'logo' => 'no-image.jpg',
        ]);
        \App\Models\Client::factory()->create([
            'name' => 'client 2',
            'address' => 'ponorogo',
            'province' => 'ponorogo',
            'kabupaten' => 'ponorogo',
            'zipcode' => '987789',
            'email' => 'client1@gmail.com',
            'phone' => '0980977686798',
            'fax' => '08789723',
            'logo' => 'no-image.jpg',
        ]);
    }
}
