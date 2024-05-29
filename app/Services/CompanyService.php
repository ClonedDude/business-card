<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\Company;

class CompanyService {
    public function createCompany(array $data)
    {
        $validated = Validator::make($data, [
            "admin_id" => ["required", "exists:users,id"],
            "registration_number" => ["required"],
            "address" => ["required"],
            "phone_number" => ["required"],
            "fax" => ["required"],
            "email" => ["required", "email"]
        ])->validate();

        $company = Company::create($validated);

        return $company;
    }

    public function updateCompany(int $id, array $data)
    {
        $company = Company::find($id);

        $validated = Validator::make($data, [
            "registration_number" => ["sometimes"],
            "address" => ["sometimes"],
            "phone_number" => ["sometimes"],
            "fax" => ["sometimes"],
            "email" => ["sometimes", "email"]
        ])->validate();

        $company->update($validated);

        return $company;
    }

    public function deleteCompany(int $id)
    {
        $company = Company::find($id);

        return $company->delete();
    }
}