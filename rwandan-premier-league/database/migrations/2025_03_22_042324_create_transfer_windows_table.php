<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransferWindowsTable extends Migration
{
    public function up()
    {
        Schema::create('transfer_windows', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_open')->default(false); // true = open, false = closed
            $table->date('start_date')->nullable(); // when the window opens
            $table->date('end_date')->nullable(); // when the window closes
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transfer_windows');
    }
}
