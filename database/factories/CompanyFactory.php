<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "admin_id" => User::factory()
                ->role("admin"),
            "registration_number" => $this->faker->randomNumber(5),
            "address" => $this->faker->address(),
            "phone_number" => $this->faker->phoneNumber(),
            "fax" => $this->faker->randomNumber(5),
            "email" => $this->faker->email(),
        ];
    }
}
