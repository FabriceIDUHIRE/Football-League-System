<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Matchs;
use App\Models\Announcement;
use App\Models\Revenue;
use App\Models\Player;
use App\Models\Sponsor;
use App\Models\Referee;
use App\Models\Stadium;
use App\Models\MatchCommissioner;
use App\Models\User;
use App\Models\PlayerTransfer;
use App\Models\Goal;
use App\Models\Injury;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{



    
    public function index()
    {
        $teamCount = Team::count();
        $teams = Team::all();
        $matches = Matchs::latest()->take(5)->get();
        $announcements = Announcement::latest()->take(5)->get();
        $totalRevenue = Revenue::sum('amount');
        $standings = Team::orderByRaw('IFNULL(points, 0) DESC')->get();
        $announcementCount = Announcement::count();
    
        // New Counts
        $playerCount = Player::count();
        $refereeCount = Referee::count();
        $stadiumCount = Stadium::count();
        $matchCommissionerCount = MatchCommissioner::count();
        $sponsorCount = Sponsor::count();
        $userCount = User::count();
    
        $transferApproved = PlayerTransfer::where('status', 'Approved')->count();
        $transferRejected = PlayerTransfer::where('status', 'Rejected')->count();
        $transferPending = PlayerTransfer::where('status', 'Pending')->count();
    
        return view('dashboard.index', compact(
            'teams', 'matches', 'announcements', 'totalRevenue', 'standings', 'teamCount', 'announcementCount',
            'playerCount', 'refereeCount', 'stadiumCount', 'matchCommissionerCount', 'sponsorCount', 'userCount',
            'transferApproved', 'transferRejected', 'transferPending'
        ));
    }
    



    public function showLeagueStandings()
    {
        // Fetching standings with additional columns
        $standings = Team::orderBy('points', 'desc')->get();

        // Pass the standings data to the view
        return view('standings.index', compact('standings'));
    }

    // Example method to handle an update (e.g., updating match or announcement data)
    public function updateMatchResults(Request $request, $matchId)
    {
        // Add validation rules as needed
        $request->validate([
            'result' => 'required|string|max:255', // Example validation rule
        ]);

        $match = Matchs::findOrFail($matchId);
        $match->update($request->all());

        // After updating, redirect with a success message
        return redirect()->route('dashboard.index')->with('success', 'Match results updated successfully!');
    }

    public function updateAnnouncement(Request $request, $announcementId)
    {
        $announcement = Announcement::findOrFail($announcementId);
        $announcement->update($request->all());

        // Redirect with success message
        return redirect()->route('dashboard.index')->with('success', 'Announcement updated successfully!');
    }




    public function allPlayers(Request $request)
    {
        $teams = Team::all(); // Get all teams
        $selectedTeam = $request->input('team_id'); // Get selected team from query parameters
    
        // Filter players based on the selected team, or get all players if no team is selected
        if ($selectedTeam) {
            $players = Player::where('team_id', $selectedTeam)->select('id', 'name', 'team_id', 'position', 'image')->with('team')->get();
        } else {
            $players = Player::select('id', 'name', 'team_id', 'position', 'image')->with('team')->get();
        }
    
        return view('players.index', compact('players', 'teams', 'selectedTeam'));
    }



    public function showPlayer($id)
    {
        $player = Player::with('team')->findOrFail($id);
    
        // Fetch performance stats from the goals table
        $goals = Goal::where('player_id', $id)->sum('goal_scored');
        
        // Count yellow and red cards from the goals table
        $yellowCards = Goal::where('player_id', $id)->where('card', 'yellow')->count();
        $redCards = Goal::where('player_id', $id)->where('card', 'red')->count();
    
        // Fetch injuries from the goals table
        $injuries = Goal::where('player_id', $id)->whereNotNull('injury')->get();
    
        return view('players.show', compact('player', 'goals', 'yellowCards', 'redCards', 'injuries'));
    }

    


    // Filter and display sponsors based on query parameters
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'sponsor_name' => 'required|string|max:255',
            'contract_start_date' => 'required|date',
            'contract_end_date' => 'required|date',
            'amount' => 'required|numeric',
            'team_id' => 'nullable|exists:teamss,id',  // Team ID is nullable, but must exist if provided
        ]);
    
        // Check if the logged-in user is an admin
        if (Auth::user()->isAdmin()) {
            // Admin doesn't have a team, so we set team_id to null
            $teamId = null;
            $userId = Auth::id(); // Admin's user_id
        } else {
            // For team users, we set team_id based on the team the user belongs to
            $teamId = Auth::user()->team->id; // Team user's associated team ID
            $userId = null; // User ID is not needed for team users
        }
        
        Sponsor::create([
            'sponsor_name' => $request->sponsor_name,
            'contract_start_date' => $request->contract_start_date,
            'contract_end_date' => $request->contract_end_date,
            'amount' => $request->amount,
            'user_id' => $userId,  // Store admin's user_id
            'team_id' => $teamId,  // Admin's team_id will be null
        ]);
        
    
        // Redirect back with success message
        return redirect()->route('sponsors.index')->with('success', 'Sponsor added successfully!');
    }
    
    
    
    public function sponsorsIndex(Request $request)
    {
        $query = Sponsor::query();
    
        // Check if the logged-in user is an admin
        if (Auth::user()->isAdmin()) {
            // Admin can filter by league_sponsor if the parameter is set
            if ($request->filled('league_sponsor')) {
                $query->where('league_sponsor', $request->league_sponsor);
            }
    
            // Admins should see sponsors where team_id is NULL
            $query->whereNull('team_id');
        } else {
            // For team users, show sponsors related to their team (by team_id)
            $teamId = Auth::user()->team->id;  // Get the team ID for the logged-in user
            $query->where('team_id', $teamId);  // Filter sponsors by the user's team_id
        }
    
        // Paginate the results
        $sponsors = $query->paginate(10);
    
        return view('sponsors.index', compact('sponsors'));
    }

    

    public function edit($id)
{
    $sponsor = Sponsor::findOrFail($id);
    return view('sponsors.edit', compact('sponsor'));
}

public function update(Request $request, $id)
{
    $sponsor = Sponsor::findOrFail($id);

    $request->validate([
        'sponsor_name' => 'required|string|max:255',
        'contract_start_date' => 'required|date',
        'contract_end_date' => 'required|date|after_or_equal:contract_start_date',
        'amount' => 'required|numeric|min:0',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('logos', 'public');
        $sponsor->logo = $logoPath;
    }

    $sponsor->update($request->all());

    return redirect()->route('sponsors.index')->with('success', 'Sponsor updated successfully.');
}

public function destroy($id)
{
    $sponsor = Sponsor::findOrFail($id);
    
    // Delete logo file if exists
    if ($sponsor->logo) {
        Storage::delete('public/' . $sponsor->logo);
    }

    $sponsor->delete();

    return redirect()->route('sponsors.index')->with('success', 'Sponsor deleted successfully.');
}

    






}
