<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Services\CompanyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    public function index()
    {
        return view("pages.company.index");
    }

    public function data()
    {
        $companies_query = Company::select("*")
            ->with(["admin"]);

        return DataTables::of($companies_query)
            ->addColumn("logo", function ($row) {
                return $row->logo_url
                    ? view("components.image-preview", ["url" => $row->logo_url, "title" => "{$row->name} company logo"])->render()
                    : null;
            })
            ->addColumn("admin_name", function ($row) {
                return $row->admin->name;
            })
            ->addColumn("action", function ($row) {
                $detail_button = '';
                $edit_button = '';
                $delete_button = '';
                
                if (Auth::user()->can('companies.view')) {
                $detail_button
                    = '<a href="'.route('companies.show', $row->id).'" class="btn btn-sm btn-primary me-2 mb-4">
                        <i class="fas fa-eye"></i>
                        Detail
                    </a>';
                }

                if (Auth::user()->can('companies.update')) {
                $edit_button
                    = '<a href="'.route('companies.edit', $row->id).'" class="btn btn-sm btn-info me-2 mb-4">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>';
                }

                if (Auth::user()->can('companies.delete')) {
                $delete_button
                    = '<form class="delete-training-form" action="'.route('companies.delete', $row->id).'" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this company? This action cannot be undone.\')">
                        '.csrf_field().'
                        <button type="submit" class="btn btn-sm btn-danger me-2 mb-4"> 
                        <i class="fas fa-trash"></i>
                        Delete</button>
                    </form>';
                }

                $html = "<div class='d-flex flex-row'>
                    $detail_button
                    $edit_button
                    $delete_button
                </div>";

                return $html;
            })
            ->rawColumns(["logo", "action"])
            ->make(true);
    }

    public function show($id)
    {
        $company = Company::findOrFail($id);

        return view("pages.company.show", compact("company"));
    }

    public function create()
    {
        return view("pages.company.create");
    }

    public function store(Request $request, CompanyService $companyService)
    {
        $company = $companyService->createCompany(
            array_merge(
                ["admin_id" => Auth::id()],
                $request->all()
            )
        );

        return redirect(route("companies.index"))
            ->with("success", "company created successfully");
    }

    public function edit(int $id)
    {
        $company = Company::find($id);

        return view("pages.company.edit", compact("company"));
    }

    public function update(Request $request, CompanyService $companyService, int $id)
    {
        $companyService->updateCompany($id, $request->all());

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