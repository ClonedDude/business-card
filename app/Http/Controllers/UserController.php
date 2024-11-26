<?php

namespace App\Http\Controllers;

use App\Models\CompanyUser;
use App\Models\Company;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()
    {
        return view("pages.user.index");
    }

    public function data()
    {
        $users_query = User::select("*")
            ->with(["companies"]);
        
        return DataTables::of($users_query)
            ->addColumn("companies", function ($row) {
                $companies_html = "";
                
                foreach ($row->companies as $company) {
                    $companies_html .= "<span class='badge bg-primary m-2'>{$company->name}</span>";
                }

                return $companies_html;
            })
            
            ->addColumn("roles", function ($row) {
                $roles_html = "";
    
                foreach ($row->roles as $role) {
                    $roles_html .= "<span class='badge bg-success m-2'>{$role->name}</span>";
                }
    
                return $roles_html;
            })

            ->addColumn("action", function ($row) {
                // $detail_button
                //     = '<a href="'.route('users.show', $row->id).'" class="btn btn-sm btn-primary me-2 mb-4">
                //         <i class="fas fa-eye"></i>
                //         Detail
                //     </a>';
                $edit_button = '';
                $delete_button = '';

                if (Auth::user()->can('users.update')) {  
                    $edit_button
                    = '<a href="'.route('users.edit', $row->id).'" class="btn btn-sm btn-info me-2 mb-4">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>';
                }

                if (Auth::user()->can('users.delete')) {  

                    $delete_button
                        = '<form class="delete-training-form" action="'.route('users.delete', $row->id).'" method="POST">
                            '.csrf_field().'
                            <button type="submit" class="btn btn-sm btn-danger me-2 mb-4"> 
                            <i class="fas fa-trash"></i>
                            Delete</button>
                        </form>';
                }

                $html = "<div class='d-flex flex-row'>
                    $edit_button
                    $delete_button
                </div>";

                return $html;
            })
            
            ->rawColumns([
                "companies", "roles", "action"
                ])
            ->make(true);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view("pages.user.detail", compact("user"));
    }

    public function create()
    {
        $companyUser = CompanyUser::where('user_id', Auth::user()->id)->get();
        // Extract all company IDs
        $companyIds = $companyUser->pluck('company_id');

        // Retrieve the corresponding companies
        $companies = Company::whereIn('id', $companyIds)->get();       
        $roles = Role::where("company_id", getPermissionsTeamId())->get();
        return view("pages.user.create", compact("companies", "roles"));
    }

    public function store(Request $request, UserService $userService)
    {
        $user = $userService->createUser($request->all());

        return redirect(route("users.index"))
            ->with("success", "user created successfully");
    }

    public function edit(int $id)
    {
        $user = User::find($id);
        $companyUser = CompanyUser::where('user_id', $user);
        // Extract all company IDs
        $companyIds = $companyUser->pluck('company_id');

        $companies = Company::whereIn('id', $companyIds)->get();       
        $roles = Role::where("company_id", getPermissionsTeamId())->get();
        return view("pages.user.edit", compact("user", "companies", "roles"));
    }

    public function update(Request $request, UserService $userService, int $id)
    {
        $user = $userService->updateUser($id, $request->all());

        return redirect(route("users.index"))
            ->with("success", "user updated successfully");
    }

    public function delete(Request $request, UserService $userService, int $id)
    {
        $userService->deleteUser($id);

        return redirect(route("users.index"))
            ->with("success", "user deleted successfully");
    }
}
