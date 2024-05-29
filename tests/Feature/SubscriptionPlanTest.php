<?php

namespace Tests\Feature;

use App\Models\SubscriptionPlan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionPlanTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get(route("subscription-plans.index"));
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $subscription_plan = SubscriptionPlan::factory()->create();

        $response = $this->get(route("subscription-plans.show", $subscription_plan->id));
        $response->assertStatus(200);
    }

    public function test_create()
    {
        $response = $this->get(route("subscription-plans.create"));
        $response->assertStatus(200);        
    }

    public function test_store()
    {
        $data = SubscriptionPlan::factory()
            ->make()
            ->toArray();

        $response = $this->post(route("subscription-plans.store"), $data);
        $response->assertStatus(302);
    }

    public function test_edit()
    {
        $subscription_plan = SubscriptionPlan::factory()->create();
        
        $response = $this->get(route("subscription-plans.edit", $subscription_plan->id));
        $response->assertStatus(200);        

        $this->assertTrue($subscription_plan::exists($subscription_plan->id));
    }

    public function test_update()
    {
        $subscription_plan = SubscriptionPlan::factory()->create();

        $data = SubscriptionPlan::factory()
            ->make()
            ->toArray();
        
        $response = $this->post(route("subscription-plans.update", $subscription_plan->id), $data);
        $response->assertStatus(302);
        
        $this->assertTrue($subscription_plan::exists($subscription_plan->id));
    }

    public function test_delete()
    {
        $subscription_plan = SubscriptionPlan::factory()->create();
        
        $response = $this->post(route("subscription-plans.delete", $subscription_plan->id));
        $response->assertStatus(302);      

        $this->assertFalse($subscription_plan::exists($subscription_plan->id));
    }
}
