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
        Schema::create('loan_deals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained(); // Ensure this references the correct table
            $table->foreignId('team_id')->constrained('teamss'); // Update the table name here
            $table->date('loan_start_date');
            $table->date('loan_end_date');
            $table->boolean('has_buy_clause')->default(false);
            $table->decimal('buy_clause_fee', 10, 2)->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_deals');
    }
};
