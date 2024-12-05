<?php

namespace App\Services;

use App\Models\Company;
use Carbon\Traits\Timestamp;
use Illuminate\Support\Facades\Validator;
use App\Models\Expense;
use App\Models\ExpenseApproval;
use App\Models\ExpenseItem;
use App\Models\Companies;
use App\Models\CompanyUser;
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
        $companyId = session('company_id');
        $request['company_id'] = $companyId;

        $request->validate([
            'expense_name' => 'required|string|max:255',
            'additional_details' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'date_of_expense' => 'required|date',
            'items' => 'sometimes|array',
            'items.*.item_id' => 'sometimes|exists:expense_items,id',
            'items.*.quantity' => 'sometimes|integer|min:1',
            "receipt_picture" => ["sometimes", "image", "max:8192", "nullable"],
        ]);


        // Create the new expense record
        $expense = Expense::create([
            'user_id' => $user->id,  // Authenticated user's ID
            'expense_name' => $request->expense_name,
            'additional_details' => $request->additional_details,
            'total_amount' => $request->total_amount,
            'company_id' => $companyId,
            'currency' => $request->currency,
            'date_of_expense' => $request->date_of_expense,
            'approval' => $request->approval,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $expense->uploadReceiptPicture($request["receipt_picture"]);

        $subtotal = 0;
       
        if($request->items) {
        // Loop through the items and save them as transaction items
        foreach ($request->items as $item) {
            // Find the expense item 
            $expenseItem = ExpenseItem::findOrFail($item['item_id']);
            // Calculate subtotal for each item (price * quantity)
            $subtotal += $item['price'] * $item['quantity'];

            // Create the expense transaction item
            ExpenseTransactionItem::firstOrCreate([
                'expense_id' => $expense->id,
                'expense_item_id' => $expenseItem->id,
                'quantity' => $item['quantity'],
                'price' => $expenseItem->price,
                'currency' => $expenseItem->currency, // Assuming currency comes from the item
                'subtotal' => $subtotal,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        }
        
      }
    

    

    public function updateExpense(int $id, Request $request)
    {
        $expense = Expense::findOrFail($id);
        $user = Auth::user();
        $request['user_id'] = $user->id;

        $companyID = session('company_id');
        $request['company_id'] = $companyID;

        $validated = $request->validate([
            'expense_name' => 'required|string|max:255',
            'additional_details' => 'nullable|string|max:255',
            'total_amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'date_of_expense' => 'required|date',
            'company_id' => 'sometimes|integer',
            'items' => 'sometimes|array',
            'items.*.item_id' => 'sometimes|exists:expense_items,id',
            'items.*.quantity' => 'sometimes|integer|min:1',
            'approval' => 'required|integer'
        ]);

        //If approval is true (1), update expense approval
        if ($validated['approval'] == 1) {
            ExpenseApproval::create([
                'expense_id' => $id,
                'company_id' => $validated['company_id'],
                'user_id' => $user->id,
                'updated_at' => now(),
                'created_at' => now(),
            ]);
        }
        else {
            ExpenseApproval::where('expense_id', $id)->delete();
        }
        
        $subtotal = 0;
        ExpenseTransactionItem::where('expense_id', $id)->delete();//delete all old item transactions

        if($request->items) {
            foreach ($request->items as $item) {
            // Find the expense item 
            $expenseItem = ExpenseItem::findOrFail($item['item_id']);
            // Calculate subtotal for each item (price * quantity)
            $subtotal += $item['price'] * $item['quantity'];

            // Create the expense transaction item
            ExpenseTransactionItem::firstOrCreate([
                'expense_id' => $id,
                'expense_item_id' => $expenseItem->id,
                'quantity' => $item['quantity'],
                'price' => $expenseItem->price,
                'currency' => $expenseItem->currency, // Assuming currency comes from the item
                'subtotal' => $subtotal
            ]);
            }
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