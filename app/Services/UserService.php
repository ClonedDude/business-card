<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserService {
    public function createUser(array $data)
    {
        $validated = Validator::make($data, [

        ])->validate();

        $user = User::create($validated);

        return $user;
    }

    public function updateUser(int $id, array $data)
    {
        $user = User::find($id);

        $validated = Validator::make($data, [

        ])->validate();

        $user->update($validated);

        return $user;
    }

    public function deleteUser(int $id)
    {
        $user = User::find($id);

        return $user->delete();
    }
}