<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Shift::factory()->create([
            'id' => '1',
            'jabatan_id' => '1',
            'client_id' => '1',
            'shift_name' => 'Shift Pagi',
            'jam_start' => '08:00:00',
            'jam_end' => '15:30:00'
        ]);

        \App\Models\Shift::factory()->create([
            'id' => '2',
            'jabatan_id' => '2',
            'client_id' => '2',
            'shift_name' => 'Shift Sore',
            'jam_start' => '14:00:00',
            'jam_end' => '20:30:00'
        ]);
    }
}
