<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\Subscription;

class SubscriptionService {
    public function createSubscription(array $data)
    {
        $validated = Validator::make($data, [

        ])->validate();

        $subscription = Subscription::create($validated);

        return $subscription;
    }

    public function updateSubscription(int $id, array $data)
    {
        $subscription = Subscription::find($id);

        $validated = Validator::make($data, [

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