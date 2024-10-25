<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\Expense;
use App\Models\ExpenseItem;
use App\Models\ExpenseTransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class ExpenseService {
    
      // Store function to handle the creation of new expenses with items
      public function createExpense(Request $request)
      {
        // Get the authenticated user
        $user = Auth::user();

        $request['user_id'] = $user->id;

        $request->validate([
            'expense_name' => 'required|string|max:255',
            'additional_details' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'date_of_expense' => 'required|date',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:expense_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'approval' => 'required|boolean'
        ]);

        // Create the new expense record
        $expense = Expense::create([
            'user_id' => $user->id,  // Authenticated user's ID
            'expense_name' => $request->expense_name,
            'additional_details' => $request->additional_details,
            'total_amount' => $request->total_amount,
            'currency' => $request->currency,
            'date_of_expense' => $request->date_of_expense,
            'approval' => $request->approval,
        ]);
        $subtotal = 0;

        // Loop through the items and save them as transaction items
        foreach ($request->items as $item) {
            // Find the expense item 
            $expenseItem = ExpenseItem::findOrFail($item['id']);
            // Calculate subtotal for each item (price * quantity)
            $subtotal += $item['price'] * $item['quantity'];

            // Create the expense transaction item
            ExpenseTransactionItem::create([
                'expense_id' => $expense->id,
                'expense_item_id' => $expenseItem->id,
                'quantity' => $item['quantity'],
                'price' => $expenseItem->price,
                'currency' => $expenseItem->currency, // Assuming currency comes from the item
                'subtotal' => $subtotal
            ]);
        }
      }
    

    

    public function updateExpense(int $id, Request $request)
    {
        $expense = Expense::findOrFail($id);
        $user = Auth::user();
        $request['user_id'] = $user->id;

        $validated = $request->validate([
            'expense_name' => 'required|string|max:255',
            'additional_details' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'date_of_expense' => 'required|date',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:expense_items,id',
            'items.*.quantity' => 'required|integer|min:1',
            'approval' => 'required|boolean'
        ]);
        
        $subtotal = 0;
        ExpenseTransactionItem::where('expense_id', $id)->delete();

        foreach ($request->items as $item) {
            // Find the expense item 
            $expenseItem = ExpenseItem::findOrFail($item['id']);
            // Calculate subtotal for each item (price * quantity)
            $subtotal += $item['price'] * $item['quantity'];

            // Create the expense transaction item
            ExpenseTransactionItem::create([
                'expense_id' => $id,
                'expense_item_id' => $expenseItem->id,
                'quantity' => $item['quantity'],
                'price' => $expenseItem->price,
                'currency' => $expenseItem->currency, // Assuming currency comes from the item
                'subtotal' => $subtotal
            ]);
        }
        return $expense->update($validated);
    }

    public function deleteExpense(int $id)
    {
        $expense = Expense::findOrFail($id);
        ExpenseTransactionItem::where('expense_id', $expense->id)->delete();
        return $expense->delete();
    }
}