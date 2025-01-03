<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseApproval extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'user_id', 'expense_id', 'updated_at'];

    // Define the inverse relationship (expense -> items)
    public function approvalable()
    {
        return $this->morphTo();
    }
}
