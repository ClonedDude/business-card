<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPlan;
use App\Services\SubscriptionPlanService;
use Illuminate\Http\Request;
use App\Services\RoleService;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

class SubscriptionPlanController extends Controller
{
    public function index()
    {
        return view("pages.subscription.index");
    }

    public function show($id)
    {
        $subscription_plan_rule = SubscriptionPlan::findOrFail($id);

        return view("pages.subscription.show", compact("subscription_plan_rule"));
    }

    public function data()
    {
        $companyId = session('company_id');
        $subscription_query = SubscriptionPlan::all();
        
            return DataTables::of($subscription_query)
            ->addColumn("action", function ($row) {
                $edit_button = '';
                $delete_button = '';
                
                if (Auth::user()->can('roles.update')) {
                $edit_button
                    = '<a href="'.route('subscription-plans.edit', $row->id).'" class="btn btn-sm btn-info me-2 mb-4" title="Edit">
                         Edit
                    </a>';
                }

                if (Auth::user()->can('roles.view')) {  
                    $edit_button
                    = '<a href="'.route('subscription-plans.show', $row->id).'" class="btn btn-sm btn-info me-2 mb-4">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>';
                }

                if (Auth::user()->can('roles.delete')) {
                $delete_button
                    = '<form class="delete-training-form" action="'.route('subscription-plans.delete', $row->id).'" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this role? This action cannot be undone.\')">
                        '.csrf_field().'
                        <button type="submit" class="btn btn-sm btn-danger me-2 mb-4" title="Delete">  
                            Delete
                        </button>
                    </form>';
                }

                $html = "<div class='d-flex flex-row'>
                    $edit_button
                    $delete_button
                </div>";

                return $html;
            })
            ->rawColumns(["action"])
            ->make(true);
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
