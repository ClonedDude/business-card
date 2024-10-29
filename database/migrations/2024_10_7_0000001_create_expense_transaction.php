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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();  // Primary key
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); 
            $table->string('expense_name'); // Name of the expense
            $table->text('additional_details')->nullable(); // Optional additional details
            $table->decimal('total_amount', 10, 2); // Total amount spent
            $table->string('currency', 3); // Currency (e.g., USD, EUR)
            $table->date('date_of_expense'); // Date of the expense
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->boolean('approval')->default(0); // Approval status
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
        Schema::dropIfExists('expenses');
    }
};
