<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_role = Role::create(["name" => "admin"]);

        //View permissions
        $admin_role->givePermissionTo(
            'users.delete',
            'users.view',
            'users.store',
            'users.update',

            'expenses.delete',
            'expenses.view',
            'expenses.store',
            'expenses.update',
            'expenses.approval',
            
            'contacts.delete',
            'contacts.view',
            'contacts.store',
            'contacts.update',

            'companies.delete',
            'companies.view',
            'companies.store',
            'companies.update',

            'items.delete',
            'items.view',
            'items.store',
            'items.update',

            'roles.delete',
            'roles.view',
            'roles.store',
            'roles.update',

            'external.delete',
            'external.view',
            'external.store',
            'external.update',
        );
    }
}
