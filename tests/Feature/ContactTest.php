<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get(route("contacts.index"));
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $contact = Contact::factory()->create();

        $response = $this->get(route("contacts.show", $contact->id));
        $response->assertStatus(200);
    }

    public function test_create()
    {
        $response = $this->get(route("contacts.create"));
        $response->assertStatus(200);        
    }

    public function test_store()
    {
        $data = Contact::factory()
            ->make()
            ->toArray();

        $response = $this->post(route("contacts.store"), $data);
        $response->assertStatus(302);
    }

    public function test_edit()
    {
        $contact = Contact::factory()->create();
        
        $response = $this->get(route("contacts.edit", $contact->id));
        $response->assertStatus(200);        

        $this->assertTrue($contact::exists($contact->id));
    }

    public function test_update()
    {
        $contact = Contact::factory()->create();

        $data = Contact::factory()
            ->make()
            ->toArray();
        
        $response = $this->post(route("contacts.update", $contact->id), $data);
        $response->assertStatus(302);
        
        $this->assertTrue($contact::exists($contact->id));
    }

    public function test_delete()
    {
        $contact = Contact::factory()->create();
        
        $response = $this->post(route("contacts.delete", $contact->id));
        $response->assertStatus(302);      

        $this->assertFalse($contact::exists($contact->id));
    }
}
