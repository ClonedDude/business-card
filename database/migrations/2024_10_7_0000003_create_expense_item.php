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
        Schema::create('expense_items', function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->decimal('price', 10 , 2);
            $table->string('currency');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->rememberToken();
            $table->foreignId('company_id')
            ->references('id')
            ->on('companies')
            ->onDelete('cascade');
        });
    }

    


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_items');
    }
};
