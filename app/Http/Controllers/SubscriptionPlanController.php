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
        $contact = SubscriptionPlan::findOrFail($id);

        return view("welcome", compact("contact"));
    }

    public function create()
    {
        return view("welcome");
    }

    public function store(Request $request, SubscriptionPlanService $contactService)
    {
        $contact = $contactService->createSubscriptionPlan($request->all());

        return redirect(route("contacts.index"))
            ->with("success", "contact created successfully");
    }

    public function edit()
    {
        return view("welcome");
    }

    public function update(Request $request, SubscriptionPlanService $contactService, int $id)
    {
        $contact = $contactService->updateSubscriptionPlan($id, $request->all());

        return redirect(route("contacts.index"))
            ->with("success", "contact updated successfully");
    }

    public function delete(Request $request, SubscriptionPlanService $contactService, int $id)
    {
        $contactService->deleteSubscriptionPlan($id);

        return redirect(route("contacts.index"))
            ->with("success", "contact deleted successfully");
    }
}
