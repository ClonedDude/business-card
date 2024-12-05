<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CompanyUser;
use App\Models\Company;
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
            if(Auth::user()->companies()->first()){
                $company = Auth::user()->companies()->first();
                $request->session()->put('company_id', $company->id);

                setPermissionsTeamId($company->id);
            }
        }
        $roles = Auth::user()->roles;
        $user = Auth::user();
        if(Auth::user()->companies()->first()){ 
            $company = Auth::user()->companies;
        }
        else {
            $company = '';
        }

        return view('home', compact('user', 'company', 'roles'));
    }
}
