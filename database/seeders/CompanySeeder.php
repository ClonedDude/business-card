<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::create([
            'admin_id' => 1,
            'registration_number' => 12345678,
            'name' => 'Testing.inc',
            'address' => 'Jalan test inc Satu',
            'phone_number' => '012345678',
            'fax' => '1234567',
            'email' => 'testinginc@email.com',
        ]);
    }
}
