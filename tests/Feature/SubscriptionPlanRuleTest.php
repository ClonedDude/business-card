<?php

namespace Tests\Feature;

use App\Models\SubscriptionPlanRule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionPlanRuleTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get(route("subscription-plan-rules.index"));
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $subscription_plan_rule = SubscriptionPlanRule::factory()->create();

        $response = $this->get(route("subscription-plan-rules.show", $subscription_plan_rule->subscription_plan_id));
        $response->assertStatus(200);
    }

    public function test_create()
    {
        $response = $this->get(route("subscription-plan-rules.create"));
        $response->assertStatus(200);        
    }

    public function test_store()
    {
        $data = SubscriptionPlanRule::factory()
            ->make()
            ->toArray();

        $response = $this->post(route("subscription-plan-rules.store"), $data);
        $response->assertStatus(302);
    }

    public function test_edit()
    {
        $subscription_plan_rule = SubscriptionPlanRule::factory()->create();
        
        $response = $this->get(route("subscription-plan-rules.edit", $subscription_plan_rule->subscription_plan_id));
        $response->assertStatus(200);        

        $this->assertTrue($subscription_plan_rule::exists($subscription_plan_rule->id));
    }

    public function test_update()
    {
        $subscription_plan_rule = SubscriptionPlanRule::factory()->create();

        $data = SubscriptionPlanRule::factory()
            ->make()
            ->toArray();
        
        $response = $this->post(route("subscription-plan-rules.update", $subscription_plan_rule->subscription_plan_id), [
            "rules" => [
                $data
            ]
        ]);
        $response->assertStatus(302);
        
        $this->assertTrue($subscription_plan_rule::exists($subscription_plan_rule->id));
    }
}
