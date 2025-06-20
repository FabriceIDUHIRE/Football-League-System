<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Matchs;
use App\Models\Player;
use App\Models\Sponsor;
use App\Models\Doctor;
use App\Models\Notification;
use App\Models\User;
use App\Models\staff;
use App\Models\PlayerTransfer;
use App\Models\Punishment;
use App\Models\Announcement;
use App\MOdels\Post;
use App\MOdels\injury;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class TeamDashboardController extends Controller
{



    
    // No middleware applied here

// Controller Code
public function index()
{
    $user = Auth::user();

    // Check if the user has an associated team
    if (!$user->team) {
        return redirect()->route('team.login')->withErrors(['error' => 'You are not assigned to any team.']);
    }

    $team = $user->team; // Get the authenticated user's team
    $teamId = $team->id; // Extract team ID

    // Fetch all transfers related to the team (both sending and receiving)
    $transfers = PlayerTransfer::where(function ($query) use ($teamId) {
        $query->where('to_team_id', $teamId)
              ->orWhere('from_team_id', $teamId);
    })->get();

    // Handle new transfer notification
    if ($teamId) {
        $newTransfers = PlayerTransfer::where('to_team_id', $teamId)
                                      ->where('notified', false)
                                      ->get();

        if ($newTransfers->count() > 0) {
            session()->flash('new_transfer_notification', 'You have a new transfer!');
            PlayerTransfer::where('to_team_id', $teamId)->update(['notified' => true]);
        }
    }

    // Fetch new signings for the last 24 hours
    $newSignings = Player::where('team_id', $teamId)
                         ->where('created_at', '>=', now()->subDay())
                         ->get();

    // Fetch counts for various team-related entities
    $matchesCount = Matchs::where('home_team_id', $teamId)
                         ->orWhere('away_team_id', $teamId)
                         ->count();

    $playersCount = Player::where('team_id', $teamId)->count();
    $staffCount = Staff::where('team_id', $teamId)->count();
    $doctorsCount = Doctor::where('team_id', $teamId)->count();
    $sponsorsCount = Sponsor::where('team_id', $teamId)->count();
    $punishmentsCount = Punishment::where('team_id', $teamId)->count();
    $announcementsCount = Announcement::count();
    $announcements = Announcement::orderBy('created_at', 'desc')->get();
    $postsCount = Post::where('team_id', $teamId)->count();
    $injuriesCount = Injury::where('team_id', $teamId)->count();

    return view('team.partials.index', compact(
        'team', // 🔥 Pass the team variable to the view
        'transfers', 'newSignings', 
        'matchesCount', 'playersCount', 'staffCount', 'doctorsCount', 
        'sponsorsCount', 'punishmentsCount', 'announcementsCount', 'announcements', 
        'postsCount', 'injuriesCount'
    ));
}


public function announcements()
{
    $user = auth()->user();
    
    if (!$user->team) {
        return redirect()->route('team.login')->withErrors(['error' => 'You are not assigned to any team.']);
    }

    $team = $user->team;

    // Fetch announcements for all teams (global) or specific to this team
    $announcements = Announcement::where(function ($query) use ($team) {
        $query->whereNull('team_id') // Global announcements (created by admin)
              ->orWhere('team_id', $team->id); // Team-specific announcements
    })
    ->orderBy('created_at', 'desc')
    ->get();

    return view('team.announcements', compact('announcements', 'team'));
}



public function show($id)
{
    $user = auth()->user();

    if (!$user->team) {
        return redirect()->route('team.login')->withErrors(['error' => 'You are not assigned to any team.']);
    }

    $team = $user->team; // Get the logged-in user's team
    $announcement = Announcement::findOrFail($id);

    return view('team.show', compact('announcement', 'team'));
}



    
    
    
    



    
public function profile()
{
    // Get the team profile for the logged-in user
    $user = Auth::user();
    $team = $user->team; // Assuming the user has a 'team' relation

    return view('team.partials.profile', compact('team'));
}
    




    
public function update(Request $request)
{
    // Get the team profile for the logged-in user
    $user = Auth::user();
    $team = $user->team; // Assuming the user has a 'team' relation

    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'primary_color' => 'required|string',
        'secondary_color' => 'required|string',
        'location' => 'required|string|max:255',
        'history' => 'required|string',
        'manager' => 'required|string|max:255',
    ]);

    // Update the team profile data
    $team->name = $request->input('name');
    $team->primary_color = $request->input('primary_color');
    $team->secondary_color = $request->input('secondary_color');
    $team->location = $request->input('location');
    $team->history = $request->input('history');
    $team->manager = $request->input('manager');

    // If a logo was uploaded, store it
    if ($request->hasFile('logo')) {
        $logoPath = $request->file('logo')->store('logos', 'public');
        $team->logo = $logoPath;
    }

    // Save the updated team profile
    $team->save();

    return redirect()->route('team.profile')->with('success', 'Profile updated successfully');
}

    



public function matchManagement()
{
    // Get the authenticated user
    $user = Auth::user();

    // Check if the user is associated with a team
    if (!$user->team) {
        return view('Team.match-management', ['matches' => []]);
    }

    // Get the user's team
    $team = $user->team;
    $teamId = $team->id; // Define teamId here

    // Fetch all matches where the logged-in team is either home or away
    $matches = Matchs::with(['homeTeam', 'awayTeam', 'stadium', 'referee', 'category'])
        ->where(function ($query) use ($teamId) {
            $query->where('home_team_id', $teamId)
                  ->orWhere('away_team_id', $teamId);
        })
        ->orderBy('match_date', 'asc') // Sort by date (earliest first)
        ->get(); // No limit to ensure all matches are shown

    return view('Team.match-management', compact('matches', 'team', 'teamId')); // Pass teamId here
}





    



    public function players()
    {
        $team = Auth::user();
        $players = Player::where('team_id', $team->id)->get();
        return view('Team.partials.players', compact('players'));
    }

    public function playerManagement()
    {
        $team = Auth::user();
        $players = Player::where('team_id', $team->id)->get();
        return view('Team.player-management', compact('players'));
    }




    public function sponsorship()
    {
        // Get the authenticated user
        $user = Auth::user();
    
        // Check if the user is associated with a team
        if (!$user->team) {
            return redirect()->route('team.login')->withErrors(['error' => 'You are not assigned to any team.']);
        }
    
        // Get the team associated with the authenticated user
        $team = $user->team;
    
        // Fetch sponsors associated with the user's team
        $sponsors = Sponsor::where('team_id', $team->id)->get();
    

    
        // Return the sponsorship view with the fetched sponsors
        return view('team.sponsorship', compact('sponsors', 'team'));
    }
    

    



    public function destroy($id)
{
    // Find the sponsor by ID
    $sponsor = Sponsor::findOrFail($id);
    
    // Delete the logo if it exists
    if ($sponsor->logo) {
        Storage::delete('public/' . $sponsor->logo); // Delete logo from storage
    }

    // Delete the sponsor from the database
    $sponsor->delete();

    // Redirect with a success message
    return redirect()->route('team.sponsorship')->with('success', 'Sponsor deleted successfully!');
}
    

// Filter and display sponsors based on query parameters
public function sponsorsIndex(Request $request)
{
    $query = Sponsor::query();

    // Get the logged-in user's team_id
    $teamId = Auth::user()->team->id;  // Assuming the user is correctly associated with a team

    // Filter sponsors by the logged-in user's team_id
    $query->where('team_id', $teamId);

    // Paginate the results
    $sponsors = $query->paginate(10);

    // Return the view with the sponsors data
    return view('team.sponsorship', compact('sponsors'));
}



  
    
    
    
    
    
    
       


    public function notifications()
    {
        $team = Auth::user();
        $notifications = Notification::where('team_id', $team->id)
                                     ->orWhere('type', 'league')
                                     ->get();
        return view('Team.partials.notifications', compact('notifications'));
    }

    public function performance()
    {
        $team = Auth::user();
        // Add logic to fetch performance data if needed
        return view('Team.partials.performance', compact('team'));
    }

    public function doctors()
    {
        $team = Auth::user();
        $doctors = Doctor::where('team_id', $team->id)->get();
        return view('Team.partials.doctors', compact('doctors'));
    }

    public function doctorManagement()
{
    // Check if a user is logged in
    if (!Auth::check()) {
        return redirect()->route('login')->withErrors(['error' => 'You must be logged in.']);
    }

    $team = Auth::user();

    // Ensure $team is not null
    if (!$team) {
        return redirect()->route('login')->withErrors(['error' => 'User not found.']);
    }

    $doctors = Doctor::where('team_id', $team->id)->get();

    return view('Team.doctor-management', compact('doctors'));
}

    
    
    public function security()
    {
        return view('Team.partials.security');
    }

    // Staff 
    public function staff()
    {
        // Retrieve the team object for the logged-in user
        $team = auth()->user()->team;
    
        // Count the number of staff members in the logged-in user's team
        $staffCount = Staff::where('team_id', $team->id)->count();
    
        return view('team.staff', compact('staffCount'));
    }
    


// Punishment
public function punishments()
{
    $punishmentsCount = Punishment::where('team_id', auth()->user()->team_id)->count(); // Or your own logic
    return view('team.punishments', compact('punishmentsCount'));
}




//Posts
public function posts()
{
    $postsCount = Post::where('team_id', auth()->user()->team_id)->count(); // Adjust this as needed
    return view('team.posts', compact('postsCount'));
}


    public function showDashboard()
{
    // Fetch the count of upcoming matches
    $upcomingMatchesCount = Matchs::where('date', '>', now())->count();

    // Pass the variable to the view
    return view('Team.partials.index', compact('upcomingMatchesCount'));
}



public function dashboard() {
    if (Auth::check()) {
        $team = Auth::user()->team;
        return view('team_dashboard', compact('team'));
    }

    return redirect()->route('login');  // If user is not authenticated
}




public function logout()
{
    Auth::guard('team')->logout();
    session()->flush();  // Clears the session data completely

    return redirect()->route('auth.team-login')->with('success', 'Logged out successfully.');
}





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



public function standings()

{

    $teamId = Auth::user()->team_id;
    $team = Team::find($teamId);
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

    return view('team.standings', compact('standings','team'));
}


}
