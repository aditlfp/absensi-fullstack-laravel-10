<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KerjasamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Kerjasama::factory()->create([
            'client_id' => '1',
            'value' => '1000000',
            'experied' => '2077-01-01',
            'approve1' => '1',
            'approve2' => '2',
            'approve3' => '3',
        ]);
        \App\Models\Kerjasama::factory()->create([
            'client_id' => '2',
            'value' => '1000000',
            'experied' => '2077-01-01',
            'approve1' => '1',
            'approve2' => '2',
            'approve3' => '3',
        ]);
    }
}
