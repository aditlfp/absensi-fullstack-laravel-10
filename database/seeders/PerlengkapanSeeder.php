<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerlengkapanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Perlengkapan::factory()->create([
            'name' => 'masker'
        ]);
        \App\Models\Perlengkapan::factory()->create([
            'name' => 'name tag'
        ]);
    }
}
