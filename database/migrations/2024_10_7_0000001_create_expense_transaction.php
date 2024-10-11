<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expenses', function (Blueprint $table){
            $table->bigIncrements('id'); // expense id
            $table->string('expense_name');
            $table->string('additional_details');
            $table->integer('total_amount');
            $table->string('currency');
            $table->date('date_of_expense');
            $table->boolean('approval');
            $table->timestamp('expense_created_at')->nullable();
            $table->unsignedBigInteger('user_ID');
            $table->rememberToken();
            $table->timestamps();
            
            $table->foreign('user_ID' )
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
