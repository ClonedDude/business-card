<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_at_carbon = Carbon::now()->subDays(rand(10, 20));

        return [
            "subscription_plan_id" => SubscriptionPlan::factory(),
            "user_id" => User::factory()
                ->role("user"),
            "company_id" => Company::factory(),
            "start_at" => $start_at_carbon->format("Y-m-d"),
            "expire_at" => $start_at_carbon->format("Y-m-d"),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Subscription $subscription) {
                $subscription->update([
                    "expire_at" => Carbon::parse($subscription->start_at)->subDays(-($subscription->subscription_plan->duration))->format("Y-m-d")
                ]);
            })
            ->afterCreating(function (Subscription $subscription) {
                $subscription->update([
                    "expire_at" => Carbon::parse($subscription->start_at)->subDays(-($subscription->subscription_plan->duration))->format("Y-m-d")
                ]);
            });
    }
}
