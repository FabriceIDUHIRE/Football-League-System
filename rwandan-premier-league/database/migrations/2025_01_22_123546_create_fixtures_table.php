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
    Schema::create('fixtures', function (Blueprint $table) {
        $table->id();
        $table->foreignId('home_team_id')->constrained('teamss')->onDelete('cascade');
        $table->foreignId('away_team_id')->constrained('teamss')->onDelete('cascade');
        $table->foreignId('stadium_id')->constrained('stadiums')->onDelete('cascade');
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        $table->datetime('match_date');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};
