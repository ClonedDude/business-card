<?php

namespace Tests\Feature;

use App\Models\ExternalLink;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExternalLinkTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get(route("external-links.index"));
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $external_link = ExternalLink::factory()->create();

        $response = $this->get(route("external-links.show", $external_link->id));
        $response->assertStatus(200);
    }

    public function test_create()
    {
        $response = $this->get(route("external-links.create"));
        $response->assertStatus(200);        
    }

    public function test_store()
    {
        $data = ExternalLink::factory()
            ->make()
            ->toArray();

        $response = $this->post(route("external-links.store"), $data);
        $response->assertStatus(302);
    }

    public function test_edit()
    {
        $external_link = ExternalLink::factory()->create();
        
        $response = $this->get(route("external-links.edit", $external_link->id));
        $response->assertStatus(200);        

        $this->assertTrue($external_link::exists($external_link->id));
    }

    public function test_update()
    {
        $external_link = ExternalLink::factory()->create();

        $data = ExternalLink::factory()
            ->make()
            ->toArray();
        
        $response = $this->post(route("external-links.update", $external_link->id), $data);
        $response->assertStatus(302);
        
        $this->assertTrue($external_link::exists($external_link->id));
    }

    public function test_delete()
    {
        $external_link = ExternalLink::factory()->create();
        
        $response = $this->post(route("external-links.delete", $external_link->id));
        $response->assertStatus(302);      

        $this->assertFalse($external_link::exists($external_link->id));
    }
}
