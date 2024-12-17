<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Expense;
use App\Models\ExpenseItem;
use App\Services\ExpenseService;
use App\Models\ExpenseTransactionItem;
use App\Models\ExternalLinkType;

use App\Models\ExpenseApproval;
use App\Models\CompanyUser;
use App\Models\User;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Yajra\DataTables\Facades\DataTables;

use function Laravel\Prompts\alert;

class ExpenseController extends Controller
{
    public function index()
    {
        $company = CompanyUser::all();
        $user = Auth::user();
        return view("pages.expense.index", compact('company', 'user'));
    }


    public function data()
    {
        $companyId = session('company_id');
        $expense_query = Expense::where('company_id', $companyId)->get();

        return DataTables::of($expense_query)
            
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
            ->addColumn("user_id", content: function ($row) {
                return $row->user_id;
            })
            ->addColumn("approval", content: function ($row) {
                if ($row->approval == 0) {
                    return "Pending";
                }
                elseif ($row->approval == 1) {
                    return "Approved";
                }
                elseif ($row->approval == 2) {
                    return "Rejected";
                }
            })
            ->addColumn("action", function ($row) {
                $edit_button = '';
                $delete_button = '';
                $reject_button = '';
                $approve_button = '';
                $detail_button = '';

                if (Auth::user()->can('expenses.view')) {
                    $detail_button
                    = '<a href="'.route('expenses.show', $row->id).'" class="btn btn-sm btn-primary me-2 mb-4">
                        Detail
                    </a>';
                }

                if (Auth::user()->can('expenses.update')) {
                    $edit_button
                    = '<a href="'.route('expenses.edit', $row->id).'" class="btn btn-sm btn-info me-2 mb-4">
                        Edit
                    </a>';
                }
                
                if (Auth::user()->can('expenses.approval')) {

                //Pending
                if ($row->approval == 0) {
                    $approve_button 
                    = '<button type="button" id="approval-btn" class="btn btn-sm me-2 mb-4 btn-success btn-approve" data-id="'. $row->id.'">
                    Approve
                    </button>';
                }

                //Approved
                if ($row->approval == 1) {
                    $approve_button 
                    = '<button type="button" id="approved-btn" class="btn btn-sm me-2 mb-4 disabled btn-success" disabled style="color:grey">
                    Approved
                    </button>';
                }

                //Rejected
                if ($row->approval == 2) {
                    $approve_button 
                    = '<button type="button" id="rejected-btn" class="btn btn-sm me-2 mb-4 btn-warning" style="color:grey" disabled>
                        Rejected
                    </button>';
                }
                
                
                 // Conditionally define $reject_button only when approval is pending (0)
                
                if ($row->approval == 0) {
                $reject_button 
                = '<button type="submit" class="btn btn-sm btn-warning me-2 mb-4 btn-reject" data-id="'. $row->id . '">Reject</button>
                </form>';
                }

                if (Auth::user()->can('expenses.delete')) {

                $delete_button
                    = '<form class="delete-training-form" action="'.route('expenses.delete', $row->id).'" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this expense? This action cannot be undone.\')">
                        '.csrf_field().'
                        <button type="submit" class="btn btn-sm btn-danger me-2 mb-4"> 
                        Delete</button>
                    </form>';
                }
                }
                $html = "<div class='d-flex flex-row equalize'>
                    $detail_button
                    $edit_button
                    $delete_button
                    $approve_button
                    $reject_button
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

    public function searchItems(Request $request)
{
    $query = $request->get('query');
    $companyId = session('company_id');

    $items = ExpenseItem::where('company_id', $companyId) 
                ->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%");
                })
                ->limit(10) 
                ->get();


    // Return the items as JSON
    return response()->json([
        'items' => $items->map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'price' => $item->price,
                'currency' => $item->currency,
            ];
        }),
    ]);
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

    public function show($id, Expense $expenseModel)
    {
        // Use eager loading to load the related expense items
        $expense = Expense::with('expenseItems.item')->findOrFail($id);  // Eager load the expenseItems
        
        $media = $expense->getMedia("receipt-picture");

        return view('pages.expense.show', compact('expense', 'media'));
    }

    public function approve($id) 
    {
        $expense = Expense::with('expenseItems')->find($id); // Load expense and its items
        $approve = $expense->approveExpense();
    }


}