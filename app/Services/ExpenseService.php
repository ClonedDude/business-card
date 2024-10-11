<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\Expense;
use Illuminate\Support\Facades\Auth;

class ExpenseService {
    public function createExpense(array $data)
    {
        $userID = Auth::id(); //get user id from authentication
        $data['user_ID'] = $userID; //insert user id into table
        $validated = Validator::make($data, [
            "expense_name" => ["sometimes", "string"],
            "additional_details" => ["sometimes", "string"],
            "total_amount" => ["sometimes", "integer"],
            "date_of_expense" => ["sometimes", "string"],
            "currency" => ["sometimes", "string"],
            "user_ID" => ["sometimes", "integer"],
            "approval" => ["sometimes", "integer"]
        ])->validate();

        $expense = Expense::create($validated);
        return $expense;
    }

    public function updateExpense(int $id, array $data)
    {
        $expense = Expense::find($id);

        $validated = Validator::make($data, [
            "expense_name" => ["sometimes", "string"],
            "additional_details" => ["sometimes", "string"],
            "total_amount" => ["sometimes", "integer"],
            "date_of_expense" => ["sometimes", "string"],
            "currency" => ["sometimes", "string"],
            "user_ID" => ["sometimes", "integer"],
            "approval" => ["sometimes", "integer"]
        ])->validate();
 
        $expense->update($validated);

        if ($validated["user_ID"] ?? false) {
            $expense->companies()->detach();
            $expense->companies()->attach($validated["user_ID"]);
        }

        return $expense;
    }

    public function deleteExpense(int $id)
    {
        $expense = Expense::find($id);

        return $expense->delete();
    }
}