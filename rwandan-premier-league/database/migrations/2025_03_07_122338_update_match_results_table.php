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
        //
        Schema::table('match_results', function (Blueprint $table) {
            // Adding statistics columns
            $table->integer('goals_home_team')->default(0);
            $table->integer('goals_away_team')->default(0);
            $table->integer('yellow_cards_home_team')->default(0);
            $table->integer('yellow_cards_away_team')->default(0);
            $table->integer('red_cards_home_team')->default(0);
            $table->integer('red_cards_away_team')->default(0);
            $table->integer('shots_on_target_home_team')->default(0);
            $table->integer('shots_on_target_away_team')->default(0);
            $table->integer('shots_off_target_home_team')->default(0);
            $table->integer('shots_off_target_away_team')->default(0);
            $table->integer('possession_home_team')->default(0); // Percentage
            $table->integer('possession_away_team')->default(0); // Percentage
            $table->integer('injured_players_home_team')->default(0);
            $table->integer('injured_players_away_team')->default(0);
            $table->integer('substitutions_home_team')->default(0);
            $table->integer('substitutions_away_team')->default(0);
            $table->integer('assists_home_team')->default(0);
            $table->integer('assists_away_team')->default(0);
            
            // Adding the 4th referee
            $table->unsignedBigInteger('fourth_referee_id')->nullable();
            $table->foreign('fourth_referee_id')->references('id')->on('referees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //

        Schema::table('match_results', function (Blueprint $table) {
            $table->dropForeign(['fourth_referee_id']);
            $table->dropColumn([
                'goals_home_team',
                'goals_away_team',
                'yellow_cards_home_team',
                'yellow_cards_away_team',
                'red_cards_home_team',
                'red_cards_away_team',
                'shots_on_target_home_team',
                'shots_on_target_away_team',
                'shots_off_target_home_team',
                'shots_off_target_away_team',
                'possession_home_team',
                'possession_away_team',
                'injured_players_home_team',
                'injured_players_away_team',
                'substitutions_home_team',
                'substitutions_away_team',
                'assists_home_team',
                'assists_away_team',
                'fourth_referee_id',
            ]);
        });
    }
};
