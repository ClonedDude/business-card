<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Expense extends Model
{
    protected $fillable = ['user_id', 'expense_name', 'total_amount', 'currency', 'additional_details','date_of_expense'];

    // Define the relationship (expense -> many expense items)
  

    public function expenseItems()
    {
        return $this->hasMany(ExpenseTransactionItem::class, 'expense_id', 'id');
    }
    
    
}
