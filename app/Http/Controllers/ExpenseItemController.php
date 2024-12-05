<?php

namespace App\Http\Controllers;

use App\Models\ExpenseItem;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Services\ExpenseItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ExpenseItemController extends Controller
{
    public function index()
    {
        return view("pages.items.index");
    }


    public function create()
    {
        $companies = Company::all();
        return view("pages.items.create", compact("companies"));
    }

    public function data()
    {
        $companyId = session(('company_id'));
        $expense_item_query = ExpenseItem::where('company_id', $companyId);
        
        return DataTables::of($expense_item_query)
            ->addColumn("placeholder", function ($row) {
                return " "; //placeholder for logo
            })
            ->addColumn("item_id", function ($row) {
                return $row->id;
             })
            ->addColumn("item_name", function ($row) {
                return $row->name;
            })
            ->addColumn("description", function ($row) {
                return $row->description;
            })
            ->addColumn("price", content: function ($row) {
                return $row->price;
            })
            ->addColumn("currency", content: function ($row) {
                return $row->currency;
            })
            ->addColumn("created_at", content: function ($row) {
                return $row->created_at;
            })
            ->addColumn("company_id", content: function ($row) {
                return $row->company_id;
            })
            ->addColumn("action", function ($row) {
                $detail_button = '';
                $edit_button = '';
                $delete_button = '';

                if (Auth::user()->can('items.view')) {
                $detail_button
                    = '<a href="'.route('items.show', $row->id).'" class="btn btn-sm btn-primary me-2 mb-4">
                        Detail
                    </a>';
                }

                if (Auth::user()->can('items.update')) {
                $edit_button
                    = '<a href="'.route('items.edit', $row->id).'" class="btn btn-sm btn-info me-2 mb-4">
                        Edit
                    </a>';
                }

                if (Auth::user()->can('items.delete')) {
                $delete_button
                    = '<form class="delete-training-form" action="'.route('items.delete', $row->id).'" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this item? This action cannot be undone.\')">
                        '.csrf_field().'
                        <button type="submit" class="btn btn-sm btn-danger me-2 mb-4"> 
                        Delete</button>
                    </form>';
                }
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

    public function store(Request $request, ExpenseItemService $expenseItemService)
    {
        $expenseItemService->createItem($request->all());

        return redirect(route("items.index"))
            ->with("success", "user created successfully");
    }

    public function edit(int $id)
    {
        $item = ExpenseItem::find($id);
        $companies = Company::all();
        return view("pages.items.edit", compact("item", "companies"));
    }

    public function update(Request $request, ExpenseItemService $expenseItemService, int $id)
    {
        $item = $expenseItemService->updateItem($id, $request->all());

        return redirect(route("items.index"))
            ->with("success", "company updated successfully");
    }

    public function delete(Request $request, ExpenseItemService $expenseItemService, int $id)
    {
        $expenseItemService->deleteExpense($id);

        return redirect(route("items.index"))
            ->with("success", "company deleted successfully");
    }

    public function show($id)
    {
        $item = ExpenseItem::findOrFail($id);

        return view("pages.items.show", compact("item"));
    }


}