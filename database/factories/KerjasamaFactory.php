<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kerjasama>
 */
class KerjasamaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => fake(),
            'value' => fake(),
            'experied' => fake(),
            'approve1' => fake(),
            'approve2' => fake(),
            'approve3' => fake(),
        ];
    }
}
