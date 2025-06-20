<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goal;
use App\Models\Matchs;
use App\Models\Team;
use App\Models\PlayerPerformance;
use App\Models\MatchResult;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeamMatchResultController extends Controller
{


public function index()
{

    $teamId = Auth::user()->team_id;
    $team = Team::find($teamId);

    $matches = Matchs::with(['homeTeam', 'awayTeam'])->get();
    $results = [];

    foreach ($matches as $match) {
        // Skip if home or away team is missing (avoid null error)
        if (!$match->homeTeam || !$match->awayTeam) {
            continue;
        }

        $homeGoals = Goal::where('match_id', $match->id)
                        ->where('team_type', 'home')
                        ->where('goal_scored', 1)
                        ->count();

        $awayGoals = Goal::where('match_id', $match->id)
                        ->where('team_type', 'away')
                        ->where('goal_scored', 1)
                        ->count();

        $results[] = [
            'match_id' => $match->id,
            'match_day' => $match->match_date,
            'home_team' => $match->homeTeam->name,
            'away_team' => $match->awayTeam->name,
            'home_goals' => $homeGoals,
            'away_goals' => $awayGoals,
        ];
    }

    $upcomingFixtures = Matchs::with(['homeTeam', 'awayTeam'])
                            ->where('match_date', '>', now())
                            ->orderBy('match_date', 'asc')
                            ->take(5)
                            ->get();

                           
    $standings = DB::table('team_standings')
                            ->join('teamss', 'team_standings.team_id', '=', 'teamss.id')
                            ->select('team_standings.*', 'teamss.name as team_name', 'teamss.id as team_id')
                            ->orderByDesc('team_standings.points')
                            ->get();
                                                

    return view('team.match_results', compact('results', 'upcomingFixtures', 'standings','team'));
}





public function showStats($matchId)
{

    $teamId = Auth::user()->team_id;
    $team = Team::find($teamId);


// Fetch match summary for the given match_id
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
        ->where('match_summary_view.match_id', $matchId)
        ->first(); // We assume there is only one row for this match

    // Fetch player performances for the given match_id
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
        ->where('player_performance_view.match_id', $matchId)
        ->get();

    // Group performances by match and player
    $groupedPerformances = [];
    foreach ($playerPerformances as $performance) {
        $playerKey = $performance->player_name;

        // Initialize player stats if not already done
        if (!isset($groupedPerformances[$playerKey])) {
            $groupedPerformances[$playerKey] = [
                'injuries' => 0,
                'cards' => 0,
                'yellow_cards' => 0,
                'red_cards' => 0,
                'goals' => 0,
            ];
        }

        // Accumulate player stats
        $groupedPerformances[$playerKey]['injuries'] += $performance->injuries;
        $groupedPerformances[$playerKey]['cards'] += $performance->cards;
        $groupedPerformances[$playerKey]['yellow_cards'] += $performance->yellow_cards;
        $groupedPerformances[$playerKey]['red_cards'] += $performance->red_cards;
        $groupedPerformances[$playerKey]['goals'] += $performance->goals;

        // Convert two yellow cards into a red card
        if ($groupedPerformances[$playerKey]['yellow_cards'] >= 2) {
            $groupedPerformances[$playerKey]['red_cards'] += 1;
            $groupedPerformances[$playerKey]['yellow_cards'] -= 2;
            $groupedPerformances[$playerKey]['cards'] += 1;
        }
    }

    // Return the data to the view
    return view('team.match_stats', compact('matchResults', 'groupedPerformances','team'));
}




}
