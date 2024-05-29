<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        return view("welcome");
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);

        return view("welcome", compact("company"));
    }

    public function create()
    {
        return view("welcome");
    }

    public function store(Request $request, CompanyService $companyService)
    {
        $company = $companyService->createCompany($request->all());

        return redirect(route("companies.index"))
            ->with("success", "company created successfully");
    }

    public function edit()
    {
        return view("welcome");
    }

    public function update(Request $request, CompanyService $companyService, int $id)
    {
        $company = $companyService->updateCompany($id, $request->all());

        return redirect(route("companies.index"))
            ->with("success", "company updated successfully");
    }

    public function delete(Request $request, CompanyService $companyService, int $id)
    {
        $companyService->deleteCompany($id);

        return redirect(route("companies.index"))
            ->with("success", "company deleted successfully");
    }
}
