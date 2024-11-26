<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyUser;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (empty(session("company_id"))) {
            $company = Auth::user()->companies()->first();
            $request->session()->put('company_id', $company->id);

            setPermissionsTeamId($company->id);
        }
        $user = Auth::user();
        $companyUsers = CompanyUser::where('user_id', $user->id )->get();
        $role = Role::all();

        //init for admin role for user 1
        if($user->id == 1) {
            $user->assignRole('admin');
        }
        $perms = Permission::all();

        return view('home', compact('user', 'companyUsers', 'role', 'perms'));
    }
}
