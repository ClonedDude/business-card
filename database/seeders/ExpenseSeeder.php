<?php

namespace Database\Seeders;

use App\Models\Expense;
use Illuminate\Database\Seeder;
use Carbon\Carbon; //for date time


class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Expense::create([
            'user_id' => 1,
            'expense_name' => 'Office Supplies',
            'additional_details' => 'Monthly purchase of office items',
            'total_amount' => 1800.00,
            'currency' => 'USD',
            'date_of_expense' => '2024-10-01',
            'approval' => 1,
        ]);

        Expense::create([
            'user_id' => 1,
            'expense_name' => 'IT Equipment',
            'additional_details' => 'Purchase of new laptops and accessories',
            'total_amount' => 3000.00,
            'currency' => 'USD',
            'date_of_expense' => '2024-09-20',
            'approval' => 1,
        ]);

        Expense::create([
            'user_id' => 1,
            'expense_name' => 'Marketing Materials',
            'additional_details' => 'Brochures and flyers for campaigns',
            'total_amount' => 500.00,
            'currency' => 'USD',
            'date_of_expense' => '2024-08-15',
            'approval' => 0,
        ]);
    }

}
