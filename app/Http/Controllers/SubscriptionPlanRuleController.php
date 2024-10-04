<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlanRule;
use App\Services\SubscriptionPlanRuleService;
use Illuminate\Http\Request;

class SubscriptionPlanRuleController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function show($subscription_plan_id)
    {
        $subscription_plan_rule = SubscriptionPlanRule::findOrFail($subscription_plan_id);

        return view("welcome", compact("subscription_plan_rule"));
    }

    public function create()
    {
        return view("welcome");
    }

    public function store(Request $request, SubscriptionPlanRuleService $subscriptionPlanRuleService, int $subscription_plan_id)
    {
        $subscriptionPlanRuleService->createSubscriptionPlanRule($subscription_plan_id, $request->all());

        return redirect(route("contacts.index"))
            ->with("success", "subscription plans rule created successfully");
    }

    public function edit()
    {
        return view("welcome");
    }

    public function update(Request $request, SubscriptionPlanRuleService $subscriptionPlanRuleService, int $subscription_plan_id)
    {
        $subscriptionPlanRuleService->updateSubscriptionPlanRule($subscription_plan_id, $request->all());

        return redirect(route("contacts.index"))
            ->with("success", "subscription plans rule updated successfully");
    }
}
