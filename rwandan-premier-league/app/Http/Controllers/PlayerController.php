<?php

namespace App\Http\Controllers;

use App\Models\Player;  // Make sure the Player model exists
use Illuminate\Http\Request;

use App\Models\Goal;
use App\Models\Injury;
use Illuminate\Support\Facades\Auth;


class PlayerController extends Controller
{



    
    // Show all players
    public function index()
    {
        $user = Auth::user();
    
        // Ensure $team is always defined
        $team = $user->team ?? null;  // If user has no team, $team will be null
    
        $players = Player::all(); // Fetch all players from the database
    
        return view('team.player-management', compact('players', 'team')); // Pass $team to the view
    }
    
    

    public function playerManagement()
    {
        // Ensure the user is authenticated
        $user = Auth::user();
    
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must be logged in.');
        }
    
        // Ensure the user has a team associated with them
        if (!$user->team) {
            return redirect()->route('team.setup')->with('error', 'You need to set up a team before adding players.');
        }
    
        // Fetch the players of the authenticated user's team
        $players = Player::where('team_id', $user->team->id)->get();
    
        // Ensure $team is passed
        $team = $user->team;
    
        return view('Team.player-management', compact('players', 'team'));
    }
    
    



    public function showPlayers()
{
    $players = Player::all();
    dd($players);  // This will dump the players to check if they're being fetched correctly
    return view('team_dashboard.player-management', compact('players'));
}

 
    


public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'position' => 'required',
        'dob' => 'required|date',
        'nationality' => 'required',
        'jersey_number' => 'required|integer',
        'contract_start_date' => 'required|date',
        'contract_end_date' => 'required|date',
        'team_id' => 'required|exists:teamss,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',  // Add image validation
    ]);

    // Handle the image upload if present
    $imagePath = null;
    if ($request->hasFile('image')) {
        // Generate a unique name for the image and store it in the 'logos' folder
        $imagePath = $request->file('image')->storeAs('logos', uniqid() . '.' . $request->file('image')->extension(), 'public');
    }

    Player::create([
        'name' => $request->name,
        'position' => $request->position,
        'dob' => $request->dob,
        'nationality' => $request->nationality,
        'jersey_number' => $request->jersey_number,
        'contract_start_date' => $request->contract_start_date,
        'contract_end_date' => $request->contract_end_date,
        'team_id' => auth()->user()->team_id,
        'image' => $imagePath,  // Save the image path
    ]);

    return redirect()->back()->with('success', 'Player added successfully!');
}


public function update(Request $request, $id)
{
    // Find the player by their ID
    $player = Player::findOrFail($id);

    // Validate the input, including the image (optional)
    $request->validate([
        'name' => 'required',
        'position' => 'required',
        'dob' => 'required|date',
        'nationality' => 'required',
        'jersey_number' => 'required|integer',
        'contract_start_date' => 'required|date',
        'contract_end_date' => 'required|date',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',  // Add image validation
    ]);

    // Handle the image upload if a new image is provided
    $imagePath = $player->image;  // Keep the existing image path

    if ($request->hasFile('image')) {
        // Delete the old image if a new one is uploaded
        if ($imagePath && file_exists(storage_path('app/public/' . $imagePath))) {
            unlink(storage_path('app/public/' . $imagePath));
        }

        // Store the new image with a unique name
        $imagePath = $request->file('image')->storeAs('logos', uniqid() . '.' . $request->file('image')->extension(), 'public');
    }

    // Update the player details
    $player->update([
        'name' => $request->input('name'),
        'position' => $request->input('position'),
        'dob' => $request->input('dob'),
        'nationality' => $request->input('nationality'),
        'jersey_number' => $request->input('jersey_number'),
        'contract_start_date' => $request->input('contract_start_date'),
        'contract_end_date' => $request->input('contract_end_date'),
        'image' => $imagePath,  // Save the new image path (or retain the old one)
    ]);

    // Redirect back with a success message
    return redirect()->route('team.player-management')->with('success', 'Player updated successfully!');
}



public function showPlayer($id)
{
    $player = Player::with('team')->findOrFail($id);

    // Debugging - check if correct player is loaded
   

    $team = $player->team;
    $goals = Goal::where('player_id', $id)->sum('goal_scored');
    $yellowCards = Goal::where('player_id', $id)->where('card', 'yellow')->count();
    $redCards = Goal::where('player_id', $id)->where('card', 'red')->count();
    $injuries = Goal::where('player_id', $id)->whereNotNull('injury')->get();

    return view('team.playerDetails', compact('player', 'team', 'goals', 'yellowCards', 'redCards', 'injuries'));
}






public function showStats($id)
{
    // Fetch the player by ID
    $player = Player::findOrFail($id);

    // Pass player data to the view
    return view('team.player-stats', compact('player'));
}


public function destroy($id)
{
    // Find the player by ID
    $player = Player::findOrFail($id);

    // Delete the player's image if it exists
    if ($player->image && file_exists(storage_path('app/public/' . $player->image))) {
        unlink(storage_path('app/public/' . $player->image));
    }

    // Delete the player
    $player->delete();

    // Redirect with success message
    return redirect()->back()->with('success', 'Player deleted successfully!');
}


}

