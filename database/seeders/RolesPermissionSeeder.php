<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesPermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions_data = [
            ["name" => "roles.*"],
            ["name" => "roles.view"],
            ["name" => "roles.store"],
            ["name" => "roles.update"],
            ["name" => "roles.delete"],
        ];

        foreach ($permissions_data as $permission_data) {
            $permission_exists = Permission::whereRaw('LOWER(name) = ?', [strtolower($permission_data["name"])])
                ->exists();

            if (!$permission_exists) {
                Permission::create($permission_data);
                echo "Created permission: " . $permission_data["name"] . "\n";
            } else {
                echo "Permission already exists: " . $permission_data["name"] . "\n";
            }
        }

        // Clear permission cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}