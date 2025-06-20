<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Player;
use App\Models\Punishment;
use App\Models\Matchs;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Basic counts
        $teamCount = Team::count();
        $announcementCount = \App\Models\Announcement::count();
        $players = Player::count();
        $totalRevenue = Ticket::sum('price');

        // Filtering logic
        $showTeams = $request->has('show_teams');
        $showPunishments = $request->has('show_punishments');
        $showMatches = $request->has('show_matches');
        $showGoals = $request->has('show_goals'); // Added filter for goals

        // Match Results with Goals
        $matches = Matchs::with(['homeTeam', 'awayTeam'])
            ->leftJoin('teamss as home_team', 'matchs.home_team_id', '=', 'home_team.id')
            ->leftJoin('teamss as away_team', 'matchs.away_team_id', '=', 'away_team.id')
            ->leftJoin('goals as g', 'matchs.id', '=', 'g.match_id')
            ->select('matchs.id', 'matchs.match_date', 
                'home_team.name as home_team', 
                'away_team.name as away_team',
                DB::raw('COALESCE(SUM(CASE WHEN g.team_type = "home" THEN g.goal_scored END), 0) as home_goals'),
                DB::raw('COALESCE(SUM(CASE WHEN g.team_type = "away" THEN g.goal_scored END), 0) as away_goals')
            )
            ->groupBy('matchs.id', 'matchs.match_date', 'home_team.name', 'away_team.name')
            ->orderBy('matchs.match_date', 'desc')
            ->take(10)
            ->get();  // Latest 10 matches with goals

        // Filtered results
        $punishments = Punishment::all(); // Fetch all punishments
        if ($showPunishments) {
            $punishments = Punishment::with('player')->get();
        }

        // Goals Scored (Top Scorers)
        $topScorers = Player::select('players.id', 'players.name', 'players.position', 'players.team_id', 'players.nationality', 'players.jersey_number', 'players.dob')
            ->selectRaw('COALESCE(SUM(goals.goal_scored), 0) as total_goals')
            ->leftJoin('goals', 'players.id', '=', 'goals.player_id')
            ->groupBy('players.id', 'players.name', 'players.position', 'players.team_id', 'players.nationality', 'players.jersey_number', 'players.dob')
            ->orderBy('total_goals', 'desc')
            ->take(10)
            ->get();

        return view('reports.index', compact(
            'teamCount',
            'announcementCount',
            'players',
            'totalRevenue',
            'matches',
            'punishments',
            'topScorers' // Pass the top scorers data
        ));
    }
}
