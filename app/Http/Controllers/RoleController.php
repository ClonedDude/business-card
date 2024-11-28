<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\User;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\alert;

class RoleController extends Controller
{
    public function index()
    {
        return view("pages.role.index");
    }

    public function data()
    {
        $roles_query = Role::select("*")
            ->where("company_id", getPermissionsTeamId());

            return DataTables::of($roles_query)
            ->addColumn("action", function ($row) {
                $edit_button = '';
                $delete_button = '';
                
                if (Auth::user()->can('roles.update')) {
                $edit_button
                    = '<a href="'.route('roles.edit', $row->id).'" class="btn btn-sm btn-info me-2 mb-4" title="Edit">
                         Edit
                    </a>';
                }

                if (Auth::user()->can('roles.delete')) {
                $delete_button
                    = '<form class="delete-training-form" action="'.route('roles.delete', $row->id).'" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this role? This action cannot be undone.\')">
                        '.csrf_field().'
                        <button type="submit" class="btn btn-sm btn-danger me-2 mb-4" title="Delete">  
                            Delete
                        </button>
                    </form>';
                }

                $html = "<div class='d-flex flex-row'>
                    $edit_button
                    $delete_button
                </div>";

                return $html;
            })
            ->rawColumns(["action"])
            ->make(true);
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);

        return view("pages.role.detail", compact("role"));
    }

    public function create()
    {
        $permissions = Permission::all();
        $user = Auth::user();        
        return view("pages.role.create", compact("permissions"));
    }

    public function store(Request $request, RoleService $roleService)
    {
        $roleService->createRole($request->all());

        return redirect(route("roles.index"))
            ->with("success", "role created successfully");
    }

    public function edit(int $id)
    {
        $role = Role::find($id);
        $permissions = Permission::all();

        return view("pages.role.edit", compact("role", "permissions"));
    }

    public function update(Request $request, RoleService $roleService, int $id)
    {
        $roleService->updateRole($id, $request->all());

        return redirect(route("roles.index"))
            ->with("success", "role updated successfully");
    }

    public function delete(Request $request, RoleService $roleService, int $id)
    {
        $roleService->deleteRole($id);

        return redirect(route("roles.index"))
            ->with("success", "role deleted successfully");
    }
}
