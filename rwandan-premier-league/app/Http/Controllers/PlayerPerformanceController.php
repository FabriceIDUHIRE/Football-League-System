<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\PlayerPerformance;

class PlayerPerformanceController extends Controller
{



    


public function index()
{
    $teamId = auth()->user()->team_id; // Assuming the user is associated with a team
    
    // Get player performances with players from the logged-in team only
    $performances = PlayerPerformance::whereHas('player', function($query) use ($teamId) {
        $query->where('team_id', $teamId); // Filter players by team
    })->with('player')->get();

    // Get all players from the logged-in user's team
    $players = Player::where('team_id', $teamId)->get();
    
    // Debugging: Check if data exists
    if ($performances->isEmpty()) {
        \Log::info('No player performance records found.');
    }

    return view('team.player-performance', compact('performances', 'players'));
}



    

public function store(Request $request)
{
    $request->validate([
        'player_id' => 'required|exists:players,id',
        'goals' => 'required|integer|min:0',
        'assists' => 'required|integer|min:0',
        'clean_sheets' => 'required|integer|min:0',
        'yellow_cards' => 'required|integer|min:0',
        'red_cards' => 'required|integer|min:0',
        'matches_played' => 'required|integer|min:0',
        'minutes_played' => 'required|integer|min:0',
    ]);

    $player = Player::find($request->player_id);
    if (!$player) {
        return redirect()->back()->with('error', 'Player not found.');
    }

    PlayerPerformance::updateOrCreate(
        ['player_id' => $request->player_id],
        [
            'team_id' => $player->team_id,
            'goals' => $request->goals,
            'assists' => $request->assists,
            'clean_sheets' => $request->clean_sheets,
            'yellow_cards' => $request->yellow_cards,
            'red_cards' => $request->red_cards,
            'matches_played' => $request->matches_played,
            'minutes_played' => $request->minutes_played,
        ]
    );

    return redirect()->back()->with('success', 'Player performance registered successfully!');
}




public function edit($id)
{
    $performance = PlayerPerformance::findOrFail($id);
    $player = $performance->player; // Assuming the performance belongs to a player

    return view('team.show-player-performance', compact('performance', 'player'));
}



public function update(Request $request, $id)
{
    // Validate the incoming data
    $validatedData = $request->validate([
        'goals' => 'required|integer|min:0',
        'assists' => 'required|integer|min:0',
        'clean_sheets' => 'required|integer|min:0',
        'matches_played' => 'required|integer|min:0',
        'minutes_played' => 'required|integer|min:0',
        'yellow_cards' => 'required|integer|min:0',
        'red_cards' => 'required|integer|min:0',
    ]);

    // Find the performance by ID
    $performance = PlayerPerformance::findOrFail($id);

    // Update the performance data
    $performance->update([
        'goals' => $validatedData['goals'],
        'assists' => $validatedData['assists'],
        'clean_sheets' => $validatedData['clean_sheets'],
        'matches_played' => $validatedData['matches_played'],
        'minutes_played' => $validatedData['minutes_played'],
        'yellow_cards' => $validatedData['yellow_cards'],
        'red_cards' => $validatedData['red_cards'],
    ]);

    // Redirect to the player performance page after update
    return redirect()->route('team.player-performance')  // Assuming 'team.player-performance' is the route for your performance overview page
                     ->with('success', 'Player performance updated successfully');
}






public function show($playerId)
{
    $player = Player::findOrFail($playerId);
    return view('team.show-player-performance', compact('player'));
}





public function destroy($id)
{
    $performance = PlayerPerformance::findOrFail($id);
    $performance->delete();

    return redirect()->back()->with('success', 'Player performance deleted successfully.');
}


}
