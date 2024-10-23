<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseItem;
use App\Services\ExpenseService;
use App\Models\ExpenseTransactionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

use function Laravel\Prompts\alert;

class ExpenseController extends Controller
{
    public function index()
    {
        return view("pages.expense.index");
    }


    public function data()
    {
        $expense_query = Expense::select('*')->where('user_id', Auth::user()->id);
        
        return DataTables::of($expense_query)
            ->addColumn("placeholder", function ($row) {
                return " "; //placeholder for logo
            })
            ->addColumn("expense_id", function ($row) {
                return $row->id;
             })
            ->addColumn("expense_name", function ($row) {
                return $row->expense_name;
            })
            ->addColumn("additional_details", function ($row) {
                return $row->additional_details;
            })
            ->addColumn("total_amount", content: function ($row) {
                return $row->total_amount;
            })
            ->addColumn("currency", content: function ($row) {
                return $row->currency;
            })
            ->addColumn("date_of_expense", content: function ($row) {
                return $row->date_of_expense;
            })
            ->addColumn("user_ID", content: function ($row) {
                return $row->user_ID;
            })
            ->addColumn("approval", content: function ($row) {
                if ($row->approval == 0) {
                    return "Not approved";
                }
                elseif ($row->approval == 1) {
                    return "Approved";
                }
            })
            ->addColumn("action", function ($row) {
                $detail_button
                    = '<a href="'.route('expenses.show', $row->id).'" class="btn btn-sm btn-primary me-2 mb-4">
                        <i class="fas fa-eye"></i>
                        Detail
                    </a>';

                $edit_button
                    = '<a href="'.route('expenses.edit', $row->id).'" class="btn btn-sm btn-info me-2 mb-4">
                        <i class="fas fa-edit"></i>
                        Edit
                    </a>';

                $delete_button
                    = '<form class="delete-training-form" action="'.route('expenses.delete', $row->id).'" method="POST">
                        '.csrf_field().'
                        <button type="submit" class="btn btn-sm btn-danger me-2 mb-4"> 
                        <i class="fas fa-trash"></i>
                        Delete</button>
                    </form>';

                $html = "<div class='d-flex flex-row'>
                    $detail_button
                    $edit_button
                    $delete_button
                </div>";

                return $html;
            })
            ->rawColumns(["action"])
            ->make(true);            
    }

    public function store(Request $request, ExpenseService $expenseService)
    {
        $expenseService->createExpense($request);
          // Redirect or return a response (as needed)
          return redirect()->route('expenses.index')
                           ->with('success', 'Expense has been successfully added.');
    }

    public function create()
    {
        return view("pages.expense.create");
    }

    public function edit(int $id)
    {
        $expense = Expense::with('expenseItems')->find($id); // Load expense and its items
        $item = ExpenseItem::all(); // List of all items for the dropdown
        return view('pages.expense.edit', compact('expense', 'item'));
    }
    
    public function update(Request $request, ExpenseService $expenseService, int $id)
    {
        $expense = $expenseService->updateExpense($id, $request);

        return redirect(route("expenses.index"))->with("success", "company deleted successfully");
    }

    public function delete(Request $request, ExpenseService $expenseService, int $id)
    {
        $expenseService->deleteExpense($id);

        return redirect(route("expenses.index"))
            ->with("success", "company deleted successfully");
    }

    public function show($id)
{
    // Use eager loading to load the related expense items
    $expense = Expense::with('expenseItems.item')->findOrFail($id);  // Eager load the expenseItems

    return view('pages.expense.show', compact('expense'));
}


}