<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Services\SubscriptionPlanService;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function show($id)
    {
        $subscription_plan_rule = SubscriptionPlan::findOrFail($id);

        return view("welcome", compact("subscription_plan_rule"));
    }

    public function create()
    {
        return view("welcome");
    }

    public function store(Request $request, SubscriptionPlanService $subscriptionPlanService)
    {
        $subscription_plan_rule = $subscriptionPlanService->createSubscriptionPlan($request->all());

        return redirect(route("subscription-plans.index"))
            ->with("success", "subscription plan created successfully");
    }

    public function edit()
    {
        return view("welcome");
    }

    public function update(Request $request, SubscriptionPlanService $subscriptionPlanService, int $id)
    {
        $subscription_plan_rule = $subscriptionPlanService->updateSubscriptionPlan($id, $request->all());

        return redirect(route("subscription-plans.index"))
            ->with("success", "subscription plan updated successfully");
    }

    public function delete(Request $request, SubscriptionPlanService $subscriptionPlanService, int $id)
    {
        $subscriptionPlanService->deleteSubscriptionPlan($id);

        return redirect(route("subscription-plans.index"))
            ->with("success", "subscription plan deleted successfully");
    }
}
