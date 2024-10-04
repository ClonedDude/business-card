<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view("user.index");
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view("welcome", compact("user"));
    }

    public function create()
    {
        return view("welcome");
    }

    public function store(Request $request, UserService $userService)
    {
        $user = $userService->createUser($request->all());

        return redirect(route("users.index"))
            ->with("success", "user created successfully");
    }

    public function edit()
    {
        return view("welcome");
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
