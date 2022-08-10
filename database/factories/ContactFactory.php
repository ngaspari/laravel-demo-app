<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'firstName' => fake()->firstName(),
            'lastName' => fake()->lastName(),
            'address' => fake()->address(),
            'city'  => fake()->city(),
            'country'  => fake()->country(),
            'phone'  => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
