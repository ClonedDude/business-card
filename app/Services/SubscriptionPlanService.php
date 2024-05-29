<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\SubscriptionPlan;

class SubscriptionPlanService {
    public function createSubscriptionPlan(array $data)
    {
        $validated = Validator::make($data, [
            "name" => ["required", "string"],
            "duration" => ["required", "integer"],
            "price" => ["required"]
        ])->validate();

        $subscription_plan = SubscriptionPlan::create($validated);

        return $subscription_plan;
    }

    public function updateSubscriptionPlan(int $id, array $data)
    {
        $subscription_plan = SubscriptionPlan::find($id);

        $validated = Validator::make($data, [
            "name" => ["required", "string"],
            "duration" => ["required", "integer"],
            "price" => ["required"]
        ])->validate();

        $subscription_plan->update($validated);

        return $subscription_plan;
    }

    public function deleteSubscriptionPlan(int $id)
    {
        $subscription_plan = SubscriptionPlan::find($id);

        return $subscription_plan->delete();
    }
}