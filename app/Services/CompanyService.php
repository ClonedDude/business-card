<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use Illuminate\Validation\Rule;

class CompanyService {
    public function createCompany(array $data)
    {
        $validated = Validator::make($data, [
            "admin_id" => ["required", "exists:users,id"],
            "registration_number" => ["required", "unique:companies,registration_number"],
            "name" => ["required", "string"],
            "address" => ["required", "string"],
            "phone_number" => ["required", "string"],
            "fax" => ["required", "string"],
            "email" => ["required", "email"],
            "website" => ["required"],
            "logo" => ["required", "max:4096"],
            "picture" => ["required", "max:4096"],
        ])->validate();

        $company = Company::create($validated);

        $company->uploadLogo($validated["logo"] ?? null);
        $company->uploadCompanyPicture($validated["picture"] ?? null);

        return $company;
    }

    public function updateCompany(int $id, array $data)
    {
        $company = Company::find($id);

        $validated = Validator::make($data, [
            "registration_number" => ["sometimes", Rule::unique('companies')->ignore($id)],
            "name" => ["sometimes", Rule::unique('companies')->ignore($id)],
            "address" => ["sometimes", "string"],
            "phone_number" => ["sometimes", "string"],
            "fax" => ["sometimes", "string"],
            "email" => ["sometimes", "email"],
            "website" => ["sometimes"],
            "logo" => ["sometimes", "max:4096"],
            "picture" => ["sometimes", "max:4096"],
        ])->validate();

        $company->update($validated);

        $company->uploadLogo($validated["logo"] ?? null);
        $company->uploadCompanyPicture($validated["picture"] ?? null);

        return $company;
    }

    public function deleteCompany(int $id)
    {
        $company = Company::find($id);

        return $company->delete();
    }
}