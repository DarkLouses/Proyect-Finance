<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bank>
 */
class BankFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'account_number' => $this->faker->randomNumber(),
            'account_type' => 'Ahorro',
            'balance' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
