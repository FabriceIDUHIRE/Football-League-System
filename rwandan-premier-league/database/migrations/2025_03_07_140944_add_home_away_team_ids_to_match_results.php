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
        Schema::table('match_results', function (Blueprint $table) {
            $table->foreignId('home_team_id')->constrained('teamss');
            $table->foreignId('away_team_id')->constrained('teamss');
        });
    }
    
    public function down()
    {
        Schema::table('match_results', function (Blueprint $table) {
            $table->dropColumn(['home_team_id', 'away_team_id']);
        });
    }
    
};
