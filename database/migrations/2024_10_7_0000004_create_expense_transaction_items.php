<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_transaction_items', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->foreignId('expense_id')->constrained('expenses')->onDelete('cascade'); // Links to expenses table
            $table->foreignId('expense_item_id')->constrained('expense_items')->onDelete('cascade'); // Links to expense items table
            $table->integer('quantity'); // Quantity of the item
            $table->decimal('price', 10, 2); // Price of a single item
            $table->decimal('subtotal', 10, 2); // Subtotal = price * quantity
            $table->string('currency', 3); // Currency for the transaction (should match item's currency)
            $table->timestamps();  // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_transaction_items');
    }
};
