<?php

namespace App\Http\Controllers;

use App\Models\ExpenseApproval;
use App\Models\Company;
use App\Models\Expense;
use App\Models\CompanyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseApprovalController extends Controller
{
    public function approveExpense( $expenseId)
    {       
        // Find the expense by ID
        $expense = Expense::find($expenseId);
        $user = Auth::user();
        $company = Company::where('admin_id', $expenseId)->first(); //under the assumption that an admin can only be in charge of one company
        $companyID = $company ? $company->id : null;
        if ($company == null  ) {
            $company = CompanyUser::where('user_id', $user->id)->first(); //under the assumption that an admin can only be in charge of one company
            $companyID = $company ? $company->id : null;
        }

        // Check if expense exists
        if (!$expense) {
            return response()->json(['error' => 'Expense not found.'], 404);
        }
      
        // Create or update an approval record for the expense
        ExpenseApproval::create([
            'expense_id' => $expenseId,
            'company_id' => $companyID,
            'user_id' => $user->id,
            'updated_at' => now(),
            'created_at' => now(),
        ]);

        $expense->update([
            'approval' => 1,
            'updated_at' => now()
        ]);
        
        return response()->json(['message' => 'Expense approved successfully.']);
    }

    public function rejectExpense($expenseId) {
        // Find the expense by ID
        $expense = Expense::find($expenseId);

        // Check if expense exists
        if (!$expense) {
            return response()->json(['error' => 'Expense not found.'], 404);
        }

        //Set expense approval status to rejected E.g. 0 = unapproved/ 1 = approved / 2 = rejected
        $expense->update([
            'approval' => 2, 
            'updated_at' => now()
        ]);

        ExpenseApproval::where('expense_id', $expenseId)->delete(); //Delete expense approval 
        
        return redirect()->route('expenses.index')
                           ->with('success', 'Expense has been successfully added.');
    }
}
