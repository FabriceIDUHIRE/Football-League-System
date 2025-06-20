<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StandingsController extends Controller
{
    // Define the method to get the last 5 matches for a given team
    public function getLast5MatchesForTeam($teamId)
    {
        // Get the last 5 matches for the team from the 'matchs' table
        // Assuming you want to get both home and away games for the team
        $matches = DB::table('matchs')
            ->where(function($query) use ($teamId) {
                $query->where('home_team_id', $teamId)
                      ->orWhere('away_team_id', $teamId);
            })
            ->orderByDesc('match_date') // Order by match date, latest first
            ->limit(5) // Get the latest 5 matches
            ->get();

        // Check if matches are available, if not, return an empty array to prevent errors
        return $matches ?: [];
    }



    
    public function index()
{
    // Ensure you're fetching standings from the database correctly
    $standings = DB::table('team_standings')
        ->join('teamss', 'team_standings.team_id', '=', 'teamss.id') // Adjust for 'teamss' table
        ->select('team_standings.*', 'teamss.name as team_name', 'teamss.id as team_id')
        ->orderByDesc('team_standings.points')
        ->get();

    // Add stats and last 5 matches for each standing
    foreach ($standings as $standing) {
        $team = DB::table('teamss')->where('id', $standing->team_id)->first(); // Use 'teamss' table
        $standing->team = $team;

        // Initialize 'stats' object and populate with necessary data
        $standing->stats = (object) [
            'played' => $standing->matches_played ?? 0,
            'wins' => $standing->wins ?? 0,
            'draws' => $standing->draws ?? 0,
            'losses' => $standing->losses ?? 0,
            'goals_for' => $standing->goals_for ?? 0,
            'goals_against' => $standing->goals_against ?? 0,
            'goal_difference' => $standing->goal_difference ?? 0,
            'points' => $standing->points ?? 0,
            'last_5_matches' => $this->getLast5MatchesForTeam($standing->team_id)
        ];
    }

    return view('standings.index', compact('standings'));
}




public function standings()
{
    // Ensure you're fetching standings from the database correctly
    $standings = DB::table('team_standings')
        ->join('teamss', 'team_standings.team_id', '=', 'teamss.id') // Adjust for 'teamss' table
        ->select('team_standings.*', 'teamss.name as team_name', 'teamss.id as team_id')
        ->orderByDesc('team_standings.points')
        ->get();

    // Add stats and last 5 matches for each standing
    foreach ($standings as $standing) {
        $team = DB::table('teamss')->where('id', $standing->team_id)->first(); // Use 'teamss' table
        $standing->team = $team;

        // Initialize 'stats' object and populate with necessary data
        $standing->stats = (object) [
            'played' => $standing->matches_played ?? 0,
            'wins' => $standing->wins ?? 0,
            'draws' => $standing->draws ?? 0,
            'losses' => $standing->losses ?? 0,
            'goals_for' => $standing->goals_for ?? 0,
            'goals_against' => $standing->goals_against ?? 0,
            'goal_difference' => $standing->goal_difference ?? 0,
            'points' => $standing->points ?? 0,
            'last_5_matches' => $this->getLast5MatchesForTeam($standing->team_id)
        ];
    }

    return view('standings.indexx', compact('standings'));
}

}

