<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->boolean('is_pre_contract')->default(false); // true if it's a pre-contract
            $table->date('pre_contract_start_date')->nullable(); // start date for pre-contract
            $table->foreignId('transfer_window_id')->nullable()->constrained(); // link to transfer window
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            //
        });
    }
};
