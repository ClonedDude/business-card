<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "customer_id" => User::factory()
                ->role("user"),
            "billcode" => null,
            "total" => 0,
            "data" => [],
        ];
    }

    public function withItemsForStoreTest($type = "subscription")
    {
        return $this->state(function ($attributes) use ($type) {
            $items = [];

            switch ($type) {
                case "subscription":
                default:
                    $subscription_plan = SubscriptionPlan::factory()->create();

                    array_push($items, [
                        "itemable_type" => "subscription-plan",
                        "itemable_id" => $subscription_plan->id,
                        "quantity" => 1,
                    ]);
                    break; 
            }

            return [
                "items" => $items
            ];
        });
    }

    public function withItemsForUpdateTest($type = "subscription")
    {
        return $this->state(function ($attributes) {
            return [];
        })->afterCreating(function (Order $order) use ($type) {
            switch ($type) {
                case "subscription":
                default:
                    $subscription_plan = SubscriptionPlan::factory()->create();

                    OrderItem::create([
                        "order_id" => $order->id,
                        "itemable_type" => "subscription-plan",
                        "itemable_id" => $subscription_plan->id,
                        "quantity" => 1,
                    ]);
                    break; 
            }
        });
    }
}
