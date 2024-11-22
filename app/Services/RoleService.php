<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleService {
    public function createRole(array $data)
    {
        $validated = Validator::make($data, [
            "name" => ["required", "string"],
            "company_id" => ["required", "integer"],
            "permissions" => ["required", "array"],
            "permissions.*" => ["required", "string"]
        ])->validate();

        $role = Role::create($validated);
        $role->syncPermissions($validated["permissions"]);
        
        return $role;
    }

    public function updateRole(int $id, array $data)
    {
        $role = Role::find($id);

        $validated = Validator::make($data, [
            "permissions" => ["required", "array"],
            "permissions.*" => ["required", "string"]
        ])->validate();

        $role->syncPermissions($validated["permissions"]);

        return $role;
    }

    public function deleteRole(int $id)
    {
        $role = Role::find($id);

        return $role->delete();
    }
}