<?php

namespace Tests\Feature;

use App\Models\ExternalLinkType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExternalLinkTypeTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get(route("external-link-types.index"));
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $external_link_types = ExternalLinkType::factory()->create();

        $response = $this->get(route("external-link-types.show", $external_link_types->id));
        $response->assertStatus(200);
    }

    public function test_create()
    {
        $response = $this->get(route("external-link-types.create"));
        $response->assertStatus(200);        
    }

    public function test_store()
    {
        $data = ExternalLinkType::factory()
            ->make()
            ->toArray();

        $response = $this->post(route("external-link-types.store"), $data);
        $response->assertStatus(302);
    }

    public function test_edit()
    {
        $external_link_types = ExternalLinkType::factory()->create();
        
        $response = $this->get(route("external-link-types.edit", $external_link_types->id));
        $response->assertStatus(200);        

        $this->assertTrue($external_link_types::exists($external_link_types->id));
    }

    public function test_update()
    {
        $external_link_types = ExternalLinkType::factory()->create();

        $data = ExternalLinkType::factory()
            ->make()
            ->toArray();
        
        $response = $this->post(route("external-link-types.update", $external_link_types->id), $data);
        $response->assertStatus(302);
        
        $this->assertTrue($external_link_types::exists($external_link_types->id));
    }

    public function test_delete()
    {
        $external_link_types = ExternalLinkType::factory()->create();
        
        $response = $this->post(route("external-link-types.delete", $external_link_types->id));
        $response->assertStatus(302);      

        $this->assertFalse($external_link_types::exists($external_link_types->id));
    }
}
