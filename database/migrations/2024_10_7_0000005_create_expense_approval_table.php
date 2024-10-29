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
        Schema::create('expense_approvals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');  // Link to companies table
            $table->unsignedBigInteger('user_id')->nullable();  // Optionally link to users table
            $table->unsignedBigInteger('expense_id')->nullable();  // Optionally link to expenses table
            
            // Foreign key constraints
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('expense_id')->references('id')->on('expenses')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approvals');
    }
};