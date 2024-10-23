<?php

namespace App\Livewire;

use App\Models\ExpenseItem;
use App\Models\User;
use Livewire\Component;

class ExpenseItemForm extends Component
{
    public $user_id, $company_id;
    public $user, $company;
    public $users, $companies;
    public $is_detail_inputs_allowed;
    public $id, $name, $description, $price, $currency, $created_at, $updated_at;
    public $item;

    public function mount($item)
    {
        if ($item) {
            $this->item = $item;
            
            $this->id = $item->id;
            $this->name = $item->name;
            $this->description = $item->description;
            $this->price = $item->price;
            $this->currency = $item->currency;
            $this->created_at = $item->created_at;
            $this->company_id = $item->company_id;
            $this->updated_at = $item->updated_at;

           
            $this->users = User::select("*")
            ->get();
            if ($this->users->count() > 1) {
                $this->user_id = $this->contact->user_id;
                $this->updatedUserId();
            }
        } else {
            $this->users = User::select("*")
                ->get();

            if ($this->users->count() > 1) {
                $this->user_id = $this->users->first()->id;
                $this->updatedUserId();
            }
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

        if ($this->item) {
            $this->company_id = $this->contact->company_id;
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

        return view('livewire.expense-item-form');
    }
}
