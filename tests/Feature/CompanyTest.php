<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    public function test_index()
    {
        $response = $this->get(route("companies.index"));
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $company = Company::factory()->create();

        $response = $this->get(route("companies.show", $company->id));
        $response->assertStatus(200);
    }

    public function test_create()
    {
        $response = $this->get(route("companies.create"));
        $response->assertStatus(200);        
    }

    public function test_store()
    {
        $data = Company::factory()
            ->make()
            ->toArray();

        $response = $this->post(route("companies.store"), $data);
        $response->assertStatus(302);
    }

    public function test_edit()
    {
        $company = Company::factory()->create();
        
        $response = $this->get(route("companies.edit", $company->id));
        $response->assertStatus(200);        

        $this->assertTrue($company::exists($company->id));
    }

    public function test_update()
    {
        $company = Company::factory()->create();

        $data = Company::factory()
            ->make()
            ->toArray();
        
        $response = $this->post(route("companies.update", $company->id), $data);
        $response->assertStatus(302);
        
        $this->assertTrue($company::exists($company->id));
    }

    public function test_delete()
    {
        $company = Company::factory()->create();
        
        $response = $this->post(route("companies.delete", $company->id));
        $response->assertStatus(302);      

        $this->assertFalse($company::exists($company->id));
    }
}
