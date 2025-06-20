<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialsTable extends Migration
{
    public function up()
    {
        Schema::create('financials', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->decimal('amount', 10, 2); // Example financial amount field
            $table->string('transaction_type'); // For example: income, expense
            $table->date('transaction_date'); // Date of the financial transaction
            $table->timestamps(); // Created at and Updated at
        });
    }

    public function down()
    {
        Schema::dropIfExists('financials');
    }
}
