<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class CompanyUserController extends Controller
{
    public function index(int $id)
    {
        $company = Company::find($id);

        return view("pages.company.show", compact("company"));
    }

    // public function create(int $id)
    // {
    //     $company = Company::find($id);

    //     return view("pages.company.show", compact("company"));
    // }

    // public function edit(int $id, int $user_id)
    // {
    //     $company = Company::find($id);
    //     $user = $company->users()->findOrFail($user_id);

    //     return view("pages.company.show", compact("company", "user"));
    // }

    // public function update(Request $request, UserService $userService, int $id, int $user_id)
    // {
    //     $company = Company::find($id);
    //     $user = $company->users()->findOrFail($user_id);

    //     $userService->updateUser($user_id, $request->all());

    //     return redirect(route("companies.users.index"))
    //         ->with("success", "user deleted sucessfully");
    // }

    // public function delete(UserService $userService, int $id, int $user_id)
    // {
    //     $company = Company::find($id);

    //     $userService->deleteUser($user_id);

    //     return redirect(route("companies.users.index", [$company->id, $user_id]))
    //         ->with("success", "user deleted sucessfully");
    // }
}
