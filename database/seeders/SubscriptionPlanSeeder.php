<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;


class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubscriptionPlan::firstOrCreate([
            'name' => "Subscription plan 1",
            'duration' => 300,
            'price' => 299.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
