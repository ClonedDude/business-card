<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function show($id)
    {
        $subscription = Subscription::findOrFail($id);

        return view("welcome", compact("subscription"));
    }

    public function edit()
    {
        return view("welcome");
    }

    public function update(Request $request, SubscriptionService $subscriptionService, int $id)
    {
        $subscription = $subscriptionService->updateSubscription($id, $request->all());

        return redirect(route("subscriptions.index"))
            ->with("success", "subscription updated successfully");
    }

    public function delete(Request $request, SubscriptionService $subscriptionService, int $id)
    {
        $subscriptionService->deleteSubscription($id);

        return redirect(route("subscriptions.index"))
            ->with("success", "subscription deleted successfully");
    }
}
