<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseTransactionItem extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'expense_transaction_items';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'expense_id',
        'expense_item_id',
        'quantity',
        'price',
        'subtotal',
        'currency',
    ];

    /**
     * Get the expense that owns the transaction item.
     */
    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    /**
     * Get the expense item that is associated with this transaction.
     */

    public function item()
    {
        return $this->belongsTo(ExpenseItem::class, 'expense_item_id');
    }


    
}
