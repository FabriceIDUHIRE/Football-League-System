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
        // Create the matchs table
        Schema::create('matchs', function (Blueprint $table) {
            $table->id();
            $table->dateTime('match_date');
            $table->foreignId('stadium_id')->constrained('stadiums')->onDelete('cascade');  // Corrected reference
            $table->foreignId('home_team_id')->constrained('teamss')->onDelete('cascade');
            $table->foreignId('away_team_id')->constrained('teamss')->onDelete('cascade');
            $table->foreignId('referee_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('match_category_id')->constrained('match_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the table
        Schema::dropIfExists('matchs');
    }
};
