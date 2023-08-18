<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name' => fake()->name(),
        'address' => fake()->address(),
        'province' => fake()->city(),
        'kabupaten' => fake()->city(),
        'zipcode' => fake(),
        'email' => fake()->email(),
        'phone' => fake()->phoneNumber(),
        'fax' => fake()->numerify(),
        'logo' => fake(),
        ];
    }
}
