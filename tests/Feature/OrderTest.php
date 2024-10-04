<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get(route("orders.index"));
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $order = Order::factory()->create();

        $response = $this->get(route("orders.show", $order->id));
        $response->assertStatus(200);
    }

    public function test_create()
    {
        $response = $this->get(route("orders.create"));
        $response->assertStatus(200);        
    }

    public function test_store()
    {
        $data = Order::factory()
            ->withItemsForStoreTest()
            ->make()
            ->toArray();

        $response = $this->post(route("orders.store"), $data);
        $response->assertStatus(302);
    }

    public function test_edit()
    {
        $order = Order::factory()
            ->withItemsForUpdateTest()
            ->create();
        
        $response = $this->get(route("orders.edit", $order->id));
        $response->assertStatus(200);        

        $this->assertTrue($order::exists($order->id));
    }

    public function test_update()
    {
        $order = Order::factory()
            ->withItemsForUpdateTest()
            ->create();

        $data = Order::factory()
            ->withItemsForStoreTest()
            ->make()
            ->toArray();
        
        $response = $this->post(route("orders.update", $order->id), $data);
        $response->assertStatus(302);
        $response->assertRedirectToRoute("orders.index");

        $order->refresh();
        $this->assertTrue($order::exists($order->id));
        $this->assertSame($data["customer_id"], $order->customer_id);
        $this->assertSame($data["billcode"], $order->billcode);
    }

    public function test_delete()
    {
        $order = Order::factory()
            ->create();
        
        $response = $this->post(route("orders.delete", $order->id));
        $response->assertStatus(302);      

        $this->assertFalse($order::exists($order->id));
    }
}
