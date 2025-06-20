<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use App\Models\Manager;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\Matchs;
use App\Models\User;
use App\Models\Role;
use App\Models\Player;

class TeamController extends Controller
{



    
    // Display all teams
    public function index()
    {
        $teams = Team::all();  // Fetch all teams
        $matches = Matchs::latest()->take(5)->get();  // Recent 5 matches
        $roles = Role::all(); 
        $user = auth()->user(); 
    
        // Fetch new signings (players with a recent transfer or contract start date)
        $newSignings = Player::whereNotNull('previous_team_id')  
            ->where('contract_start_date', '>=', now()->subMonths(6)) 
            ->with('previous_team') 
            ->get();
    
        // Pass the variables to the view
        return view('teams.index', compact('teams', 'matches', 'roles', 'user', 'newSignings'));
    }
    


    // Show the team dashboard
    public function dashboard()
{
    $user = auth()->user(); // Get the authenticated user

    if (!$user) {
        return redirect()->route('login'); // Redirect to login if no user is authenticated
    }

    return view('Team.dashboard', compact('user'));
}

    

    // Show the form for creating a new team
    public function create()
    {
        $managers = Manager::all();
        $roles = Role::all();

        return view('teams.create', compact('managers', 'roles'));
    }

    // Store a new team
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'nullable',
            'primary_color' => 'required',
            'secondary_color' => 'required',
            'location' => 'required',
            'manager' => 'nullable',
            'history' => 'nullable',
            'stadium' => 'nullable',
            'user_id' => 'nullable|exists:users,id',
        ]);

        $logoPath = $request->file('logo')->store('logos', 'public');

        $team = Team::create([
            'name' => $request->name,
            'logo' => $logoPath,
            'primary_color' => $request->primary_color,
            'secondary_color' => $request->secondary_color,
            'location' => $request->location,
            'manager' => $request->manager,
            'history' => $request->history,
            'stadium' => $request->stadium,
        ]);

        // Store the new user for the team admin
        User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'username' => $request->username,
        ]);

        return redirect()->route('teams.index')->with('success', 'Team created successfully!');
    }

    // Show a specific team
    public function show(Team $team)
    {
        return view('teams.show', compact('team'));
    }

    // Show the form for editing a specific team
    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }

    // Update a team
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'manager' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'primary_color' => 'required|string|max:7',
            'secondary_color' => 'required|string|max:7',
        ]);

        $team->name = $request->name;
        $team->location = $request->location;
        $team->manager = $request->manager;
        $team->primary_color = $request->primary_color;
        $team->secondary_color = $request->secondary_color;

        // Handle logo update if present
        if ($request->hasFile('logo')) {
            if ($team->logo) {
                Storage::disk('public')->delete($team->logo);
            }
            

            $logoPath = $request->file('logo')->store('logos', 'public');
            $team->logo = $logoPath; // Store the full path, e.g., "logos/new_image.png"
        }

        $team->save();

        return redirect()->route('teams.index')->with('success', 'Team updated successfully!');
    }

    // Delete a team
    public function destroy(Team $team)
    {
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Team deleted successfully!');
    }
}
