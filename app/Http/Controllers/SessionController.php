<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function switchCompany(Request $request)
    {
        $user = Auth::user();
        $company = $user->companies()
            ->find($request->input("company_id", null));

        if (!$company)
            return redirect(route("home"))
                ->with("error", "Access Forbidden");

        $request->session()->put('company_id', $company->id);

        return redirect(route("home"));
    }
}
