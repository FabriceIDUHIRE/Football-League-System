<?php

use Illuminate\Database\Seeder;
use App\Models\MatchResult;
use App\Models\Match;
use App\Models\Referee;

class MatchResultsSeeder extends Seeder
{
    public function run()
    {
        // Example data for match results
        MatchResult::create([
            'match_id' => 1,
            'match_status' => 'Completed',
            'home_team_score' => 2,
            'away_team_score' => 1,
            'goals_home_team' => 2,
            'goals_away_team' => 1,
            'yellow_cards_home_team' => 1,
            'yellow_cards_away_team' => 2,
            'red_cards_home_team' => 0,
            'red_cards_away_team' => 1,
            'injured_players_home_team' => 1,
            'injured_players_away_team' => 0,
            'substitutions_home_team' => 3,
            'substitutions_away_team' => 2,
            'assists_home_team' => 1,
            'assists_away_team' => 1,
            'referee_id' => 1, // assuming referee IDs exist in your referees table
            'assistant_referee_1_id' => 2,
            'assistant_referee_2_id' => 3,
            'fourth_referee_id' => 4,
        ]);

        // You can add more entries or loop to add multiple rows
    }
}

