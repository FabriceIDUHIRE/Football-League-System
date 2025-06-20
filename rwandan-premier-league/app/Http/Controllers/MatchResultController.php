<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchResultController extends Controller
{



    public function index()
{
    // Fetch match results and player performance data
    $matchResults = DB::table('match_summary_view')
        ->join('matchs', 'match_summary_view.match_id', '=', 'matchs.id')
        ->join('teamss as home_team', 'home_team.id', '=', 'matchs.home_team_id')
        ->join('teamss as away_team', 'away_team.id', '=', 'matchs.away_team_id')
        ->join('stadiums', 'stadiums.id', '=', 'matchs.stadium_id')
        ->select(
            'matchs.match_date',
            'home_team.name as home_team_name',
            'away_team.name as away_team_name',
            'stadiums.name as stadium_name',
            'match_summary_view.total_goals',
            'match_summary_view.total_injuries',
            'match_summary_view.total_cards',
            'match_summary_view.yellow_cards',
            'match_summary_view.red_cards'
        )
        ->get();

    // Fetch player performances
    $playerPerformances = DB::table('player_performance_view')
        ->join('matchs', 'player_performance_view.match_id', '=', 'matchs.id')
        ->join('players', 'player_performance_view.player_id', '=', 'players.id')
        ->join('teamss as home_team', 'home_team.id', '=', 'matchs.home_team_id')
        ->join('teamss as away_team', 'away_team.id', '=', 'matchs.away_team_id')
        ->select(
            'player_performance_view.match_id',
            'players.name as player_name',
            'home_team.name as home_team_name',
            'away_team.name as away_team_name',
            'player_performance_view.injuries',
            'player_performance_view.cards',
            'player_performance_view.yellow_cards',
            'player_performance_view.red_cards',
            'player_performance_view.goals'
        )
        ->get();

    // Group performances by match and player
    $groupedPerformances = [];
    foreach ($playerPerformances as $performance) {
        $matchKey = $performance->home_team_name . ' vs ' . $performance->away_team_name;
        $playerKey = $performance->player_name;

        if (!isset($groupedPerformances[$matchKey][$playerKey])) {
            $groupedPerformances[$matchKey][$playerKey] = [
                'injuries' => 0,
                'cards' => 0,
                'yellow_cards' => 0,
                'red_cards' => 0,
                'goals' => 0,
            ];
        }

        $groupedPerformances[$matchKey][$playerKey]['injuries'] += $performance->injuries;
        $groupedPerformances[$matchKey][$playerKey]['cards'] += $performance->cards;
        $groupedPerformances[$matchKey][$playerKey]['yellow_cards'] += $performance->yellow_cards;
        $groupedPerformances[$matchKey][$playerKey]['red_cards'] += $performance->red_cards;
        $groupedPerformances[$matchKey][$playerKey]['goals'] += $performance->goals;

        // Convert two yellow cards into a red card
        if ($groupedPerformances[$matchKey][$playerKey]['yellow_cards'] >= 2) {
            $groupedPerformances[$matchKey][$playerKey]['red_cards'] += 1;
            $groupedPerformances[$matchKey][$playerKey]['yellow_cards'] -= 2;
            $groupedPerformances[$matchKey][$playerKey]['cards'] += 1;
        }
    }

    return view('results.index', compact('matchResults', 'groupedPerformances'));
}

    
}
