<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class ExpenseForm extends Component
{
    public $user_id, $company_id;
    public $user, $company;
    public $users, $companies;
    public $is_detail_inputs_allowed;
    public $id, $expense_name, $additional_details, $total_amount, $currency, $date_of_expense, $user_ID, $approval;
    public $expense;

    public function mount($expense)
    {
        if ($expense) {
            $this->expense = $expense;
            
            $this->id = $expense->id;
            $this->expense_name = $expense->expense_name;
            $this->additional_details = $expense->additional_details;
            $this->total_amount = $expense->total_amount;
            $this->currency = $expense->currency;
            $this->date_of_expense = $expense->date_of_expense;
            $this->user_ID = $expense->user_ID;
            $this->approval = $expense->approval;

            $this->users = User::select("*")
                ->get();
        }
    }

    public function updatedUserId()
    {
        $this->getCompany();
    }

    public function getUser()
    {
        $user = User::find($this->user_id);

        $this->user = $user;
    }

    public function getCompany()
    {
        $user = User::find($this->user_id);

        $this->companies = $user->companies;

        if ($this->expense) {
            $this->company_id = $this->expense->company_id;
        } else {
            if ($this->companies->count() > 0) {
                $this->company_id = $this->companies->first()->id;
            } else {
                $this->company_id = null;
            }
        }
    }

    public function hydrate()
    {
    }

    public function render()
    {

        return view('livewire.expense-form');
    }
}
