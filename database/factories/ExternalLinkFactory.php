<?php

namespace Database\Factories;

use App\Models\ExternalLink;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExternalLink>
 */
class ExternalLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "external_link_type_id" => ExternalLink::factory(),
            "taggable_id" => User::factory()
                ->role("user"),
            "taggable_type" => User::class,
            "url" => $this->faker->url(),
        ];
    }
}
