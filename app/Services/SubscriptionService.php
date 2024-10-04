<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\Subscription;

class SubscriptionService {
    public function updateSubscription(int $id, array $data)
    {
        $subscription = Subscription::find($id);

        $validated = Validator::make($data, [
            "subscription_plan_id" => ["required"],
            "user_id" => ["required"],
            "company_id" => ["required"],
            "start_at" => ["required"],
            "expire_at" => ["required"],
        ])->validate();

        $subscription->update($validated);

        return $subscription;
    }

    public function deleteSubscription(int $id)
    {
        $subscription = Subscription::find($id);

        return $subscription->delete();
    }
}