<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\CompanyUser;
use Spatie\Permission\Models\Role;

class UserService {
    public function createUser(array $data)
    {   
        $data['created_at'] = now();
        $data['updated_at'] = now();
        $validated = Validator::make($data, [
            "name" => ["required"],
            "email" => ["required"],
            "role" => ["required"],
            "password" => ["required", "confirmed"],
            "company_id" => ["required", "exists:companies,id"],
            "profile_picture" => ["sometimes", "image", "max:8192", "nullable"],
        ])->validate();
       
        $user = User::create($validated);
        $role = Role::where("company_id", $validated["company_id"])->where("name", $validated["role"])->first();
        
        $user->companies()->attach($validated['company_id']);
        $user->assignRole($role->name);
        $user->syncRoles([$role]);
        $user->uploadProfilePicture($validated["profile_picture"] ?? null);
        $user->uploadProfilePicture($validated["profile_picture"]);

        return $user;
    }

    public function updateUser(int $id, array $data)
    {
        $user = User::find($id);
        
        $data['updated_at'] = now();
        $validated = Validator::make($data, [
            "name" => ["required"],
            "email" => ["required"],
            "role" => ["required"],
            "password" => ["nullable", "confirmed"],
            "company_id" => ["required", "exists:companies,id"],
            "profile_picture" => ["sometimes", "image", "max:8192", "nullable"],
         ])->validate();

        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);
        $user->uploadProfilePicture($validated["profile_picture"]);

        $role = Role::where("company_id", $validated["company_id"])->where("name", $validated["role"])->first();
        $user->syncRoles($role->name);
        
        if ($validated["company_id"] ?? false) {
            $user->companies()->detach();
            $user->companies()->attach($validated["company_id"]);
        }

        return $user;
    }

    public function deleteUser(int $id)
    {
        $user = User::find($id);

        return $user->delete();
    }
}