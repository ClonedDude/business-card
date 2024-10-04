<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionRuleTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get(route("subscription-rules.index"));
        $response->assertStatus(200);
    }
}
