<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Expense;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserPermissionSeeder::class,
            CompanyPermissionSeeder::class,
            ExpensePermissionSeeder::class,
            ItemPermissionSeeder::class,
            ContactPermissionSeeder::class,
            ExternalPermissionSeeder::class,
            SubscriptionPlanPermissionSeeder::class,
            RolesPermissionSeeder::class,
            RolePermissionSeeder::class,
            SubscriptionRuleSeeder::class,
            SubscriptionPlanSeeder::class,
            CompanySeeder::class,
            UserSeeder::class,
            CompanyUserSeeder::class,
            ExpenseSeeder::class,
            ExpenseItemSeeder::class,
        ]);
    }
}
