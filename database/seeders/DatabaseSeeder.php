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
            RolePermissionSeeder::class,
            SubscriptionRuleSeeder::class,
            UserSeeder::class,
            ExpenseSeeder::class,
            CompanySeeder::class,
        ]);
    }
}
