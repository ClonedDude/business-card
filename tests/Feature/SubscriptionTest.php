<?php

namespace Tests\Feature;

use App\Models\Subscription;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get(route("subscriptions.index"));
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $subscription = Subscription::factory()->create();

        $response = $this->get(route("subscriptions.show", $subscription->id));
        $response->assertStatus(200);
    }

    public function test_edit()
    {
        $subscription = Subscription::factory()->create();
        
        $response = $this->get(route("subscriptions.edit", $subscription->id));
        $response->assertStatus(200);        

        $this->assertTrue($subscription::exists($subscription->id));
    }

    public function test_update()
    {
        $subscription = Subscription::factory()->create();

        $data = Subscription::factory()
            ->make()
            ->toArray();
        
        $response = $this->post(route("subscriptions.update", $subscription->id), $data);
        $response->assertStatus(302);
        
        $this->assertTrue($subscription::exists($subscription->id));
    }

    public function test_delete()
    {
        $subscription = Subscription::factory()->create();
        
        $response = $this->post(route("subscriptions.delete", $subscription->id));
        $response->assertStatus(302);      

        $this->assertFalse($subscription::exists($subscription->id));
    }
}
