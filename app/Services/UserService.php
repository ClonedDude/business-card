<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserService {
    public function createUser(array $data)
    {
        $validated = Validator::make($data, [
            "name" => ["required"],
            "email" => ["required"],
            "password" => ["required", "confirmed"],
            "company_ids" => ["required", "array"],
            "company_ids.*" => ["required", "exists:companies,id"],
            "profile_picture" => ["sometimes", "image", "max:8192", "nullable"]
        ])->validate();

        $user = User::create($validated);

        $user->uploadProfilePicture($validated["profile_picture"]);

        if ($validated["company_ids"] ?? false){
            $user->companies()->attach($validated["company_ids"]);
        }

        return $user;
    }

    public function updateUser(int $id, array $data)
    {
        $user = User::find($id);

        $validated = Validator::make($data, [
            "name" => ["required"],
            "email" => ["required"],
            "password" => ["nullable", "confirmed"],
            "company_ids" => ["required", "array"],
            "company_ids.*" => ["required", "exists:companies,id"],
            "profile_picture" => ["sometimes", "image", "max:8192", "nullable"]
        ])->validate();
        
        if (empty($validated['password'])) {
            unset($validated['password']);
        }

        $user->update($validated);
        $user->uploadProfilePicture($validated["profile_picture"]);

        if ($validated["company_ids"] ?? false) {
            $user->companies()->detach();
            $user->companies()->attach($validated["company_ids"]);
        }

        return $user;
    }

    public function deleteUser(int $id)
    {
        $user = User::find($id);

        return $user->delete();
    }
}