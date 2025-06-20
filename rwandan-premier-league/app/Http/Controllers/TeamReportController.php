<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Matchs;
use App\Models\Player;
use App\Models\Card;
use App\Models\Injury;
use App\Models\Goal;
use Barryvdh\DomPDF\Facade as PDF;



class TeamReportController extends Controller
{
    public function index($id)
    {
        // Fetch the team with its matches, injuries, and players
        $team = Team::with(['matches', 'injuries', 'players'])->findOrFail($id);
    
        // Calculate total matches
        $totalMatches = $team->matches()->count();
    
        // Calculate total goals scored by the team
        $goalsScored = Goal::whereHas('player', function ($query) use ($id) {
            $query->where('team_id', $id);
        })->sum('goal_scored'); // 'goal_scored' column used here
    
        // Calculate total goals conceded by the team (home or away)
        $goalsConceded = Goal::whereHas('match', function ($query) use ($id) {
            $query->where(function ($subQuery) use ($id) {
                // If the team is playing at home, check for away team goals
                $subQuery->where('home_team_id', $id)
                         ->where('team_type', 'away');
            })
            ->orWhere(function ($subQuery) use ($id) {
                // If the team is playing away, check for home team goals
                $subQuery->where('away_team_id', $id)
                         ->where('team_type', 'home');
            });
        })->sum('goal_scored'); // 'goal_scored' is the column for goals conceded
    
        // Calculate yellow cards from the 'card' column in the goals table
        $yellowCards = Goal::whereHas('player', function ($query) use ($id) {
            $query->where('team_id', $id);
        })->where('card', 'yellow')->count();
    
        // Calculate red cards from the 'card' column in the goals table
        $redCards = Goal::whereHas('player', function ($query) use ($id) {
            $query->where('team_id', $id);
        })->where('card', 'red')->count();
    
        // Calculate injuries
        $injuries = Injury::whereHas('player', function ($query) use ($id) {
            $query->where('team_id', $id);
        })->count();
    
        // Get recent matches (you can change the number if you want more)
        // Ensure opponent_team is loaded with the match
        $recentMatches = $team->matches()->with('opponent_team')->orderBy('match_date', 'desc')->limit(5)->get();
    
        // Calculate the result for each recent match
        foreach ($recentMatches as $match) {
            // Get goals scored by both teams (home and away)
            $homeGoals = Goal::where('match_id', $match->id)
                             ->where('team_type', 'home')
                             ->sum('goal_scored');
    
            $awayGoals = Goal::where('match_id', $match->id)
                             ->where('team_type', 'away')
                             ->sum('goal_scored');
    
            // Determine the result based on goals scored
            if ($match->home_team_id == $team->id) {
                // If the team is the home team
                $match->result = $homeGoals > $awayGoals ? 'Win' : ($homeGoals < $awayGoals ? 'Loss' : 'Draw');
            } else {
                // If the team is the away team
                $match->result = $awayGoals > $homeGoals ? 'Win' : ($awayGoals < $homeGoals ? 'Loss' : 'Draw');
            }
        }
    
        // Pass all the data to the view
        return view('team.report', compact(
            'team', 'totalMatches', 'goalsScored', 'goalsConceded', 'yellowCards', 'redCards', 'injuries', 'recentMatches'
        ));
    }
    
    
    


    

public function downloadReport($id)
{
    // Fetch the team data
    $team = Team::with(['matches', 'injuries'])->findOrFail($id);
    
    // Load view into PDF
    $pdf = PDF::loadView('team.report', compact('team'));
    
    // Download PDF
    return $pdf->download("team_{$team->name}_report.pdf");
}

    



}
