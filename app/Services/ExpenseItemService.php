<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\Models\ExpenseItem;
use Illuminate\Support\Facades\Auth;

class ExpenseItemService {
    public function createItem(array $data)
    {
        $validated = Validator::make($data, [
            "name" => ["required", "string"],
            "company_id" => ["required", "integer"],
            "description" => ["nullable","string"],
            "price" => ["required", "numeric"],
            "currency" => ["required", "string"],
        ])->validate();
        
        $validated['created_at'] = now(); //Create timestamp of item creation
        $validated['updated_at'] = now();

        ExpenseItem::create($validated);
    }

    public function updateItem(int $id, array $data)
    {
        $item = ExpenseItem::findOrFail($id);

        $validated = Validator::make($data, [
            "name" => ["required", "string"],
            "description" => ["nullable", "string"],
            "company_id" => ["required", "integer"],
            "price" => ["required", "numeric"],
            "currency" => ["required", "string"],
        ])->validate();

        $validated['updated_at'] = now(); //update item timestamp


        if (isset($validated['description']) && $validated['description'] !== $item->description) {
            $item->description = $validated['description'];
        }
        $item->save();
        return $item->update($validated);
       
    }

    public function deleteExpense(int $id)
    {
        $item = ExpenseItem::findOrFail($id);

        return $item->delete();
    }
}