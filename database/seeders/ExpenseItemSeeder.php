<?php

namespace Database\Seeders;

use App\Models\ExpenseItem;
use Illuminate\Database\Seeder;
use Carbon\Carbon; //for date time


class ExpenseItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $item = ExpenseItem::create([
            'company_id' => 1,
            'name' => 'Camera Nikon X23',
            'description' => 'Camera Nikon',
            'price' => 800.00,
            'currency' => 'MYR',
        ]);
        ExpenseItem::create([
            'company_id' => 1,
            'name' => 'Laptop',
            'description' => 'Laptop model x456',
            'price' => 1500.00,
            'currency' => 'MYR'
        ]);

        ExpenseItem::create([
            'company_id' => 1,
            'name' => 'Headphones',
            'description' => 'Headphones Razer v3',
            'price' => 200.00,
            'currency' => 'MYR'
        ]);

        ExpenseItem::create([
            'company_id' => 1,
            'name' => 'Keyboard',
            'description' => 'Keyboard office ver1.0',
            'price' => 100.00,
            'currency' => 'MYR'
        ]);
    }

    

}
