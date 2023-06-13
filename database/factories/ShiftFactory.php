<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shift>
 */
class ShiftFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => '1',
            'jabatan_id' => '1',
            'client_id' => '1',
            'shift_name' => 'Shift Pagi',
            'jam_start' => '08:00:00',
            'jam_end' => '15:30:00'
        ];
    }
}
