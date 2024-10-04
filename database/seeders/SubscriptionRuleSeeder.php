<?php

namespace Database\Seeders;

use App\Models\SubscriptionRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rules = [
            "number of companies allowed" => "integer",
            "number of contact allowed per person" => "integer",
            "number of contact allowed per company" => "integer"
        ];

        foreach ($rules as $rule_name => $type) {
            SubscriptionRule::create([
                "name" => $rule_name,
                "type" => $type
            ]);
        }
    }
}
