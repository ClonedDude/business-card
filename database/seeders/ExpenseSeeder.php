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
        $expense = Expense::create([
            'expense_name' => 'Lunch for Example Restaurant',
            'additional_details' => 'This is for company event at Example Restaurant',
            'total_amount' => 400,
            'currency' => 'MYR',
            'date_of_expense' => Carbon::parse('2024-08-19'),
            'expense_created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'user_ID' => 1,
            
            'approval' => false,
        ]);
    }

}
