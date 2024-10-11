<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use App\Services\ExpenseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ExpenseController extends Controller
{
    public function index()
    {
        return view("pages.expense.index");
    }


    public function create()
    {
        return view("pages.expense.create");
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
        $expense = $expenseService->createExpense($request->all());

        return redirect(route("expenses.index"))
            ->with("success", "user created successfully");
    }

    public function edit(int $id)
    {
        $expense = Expense::find($id);

        return view("pages.expense.edit", compact("expense"));
    }

    public function update(Request $request, ExpenseService $expenseService, int $id)
    {
        $company = $expenseService->updateExpense($id, $request->all());

        return redirect(route("expenses.index"))
            ->with("success", "company updated successfully");
    }

    public function delete(Request $request, ExpenseService $expenseService, int $id)
    {
        $expenseService->deleteExpense($id);

        return redirect(route("expenses.index"))
            ->with("success", "company deleted successfully");
    }

    public function show($id)
    {
        $expense = Expense::findOrFail($id);

        return view("pages.expense.show", compact("expense"));
    }


}