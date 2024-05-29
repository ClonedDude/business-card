<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
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
    public function definition(): array
    {
        return [
            "company_id" => Company::factory(),
            "user_id" => function ($attributes) {
                return Company::find($attributes["company_id"])->admin_id;
            },
            "name" => $this->faker->name(),
            "address" => $this->faker->address(),
            "phone_number" => $this->faker->phoneNumber(),
            "fax" => $this->faker->randomNumber(5),
            "email" => $this->faker->email(),
        ];
    }
}
