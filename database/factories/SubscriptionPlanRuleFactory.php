<?php

namespace Database\Factories;

use App\Models\SubscriptionPlan;
use App\Models\SubscriptionPlanRule;
use App\Models\SubscriptionRule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubscriptionPlanRule>
 */
class SubscriptionPlanRuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "subscription_rule_id" => SubscriptionRule::factory(),
            "subscription_plan_id" => SubscriptionPlan::factory(),
            "value" => null,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (SubscriptionPlanRule $subscription_plan_rule) {
            switch ($subscription_plan_rule->subscription_rule->type) {
                case "integer":
                    $subscription_plan_rule->value = $this->faker->randomNumber(2);
                    break;
                case "boolean":
                    $subscription_plan_rule->value = null;
                    break;
            }

            return $subscription_plan_rule;
        });
    }
}
