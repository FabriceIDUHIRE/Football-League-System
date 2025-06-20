<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;

class BidController extends Controller
{
    // Show all bid requests for the logged-in team
    public function index()
    {
        $team = auth()->user()->team;  // Get the logged-in user's team
        
        // Get bids where this team is either selling OR buying
        $bids = Bid::where('selling_team_id', $team->id)
                   ->orWhere('buying_team_id', $team->id)
                   ->get(); 
        
        return view('bids.index', compact('bids', 'team'));
    }
    

    // Show form to send a bid request
    public function create()
    {
        $team = auth()->user()->team;  // Define the logged-in user's team
        $players = Player::where('team_id', $team->id)->get();  // Get players from the logged-in team
        $teams = Team::where('id', '!=', $team->id)->get();  // Get other teams
        return view('bids.create', compact('players', 'teams', 'team'));
    }

    // Store bid request
    public function store(Request $request)
    {
        $request->validate([
            'player_id' => 'required|exists:players,id',
            'bid_amount' => 'required|numeric|min:0',
            'buying_team_ids' => 'required|array|min:1', // Add this validation if multiple teams are selected
            'message' => 'nullable|string|max:500',
        ]);
    
        // Loop through each selected team and create a bid
        foreach ($request->buying_team_ids as $buying_team_id) {
            Bid::create([
                'player_id' => $request->player_id,
                'selling_team_id' => auth()->user()->team->id,  // Corrected code
                'buying_team_id' => $buying_team_id,
                'bid_amount' => $request->bid_amount, // Ensure bid_amount is passed
                'status' => 'Pending', // Default status as Pending
                'message' => $request->message, // Ensure this is passed from the form

            ]);
        }
    
        return redirect()->route('bids.index')->with('success', 'Bid request sent successfully!');
    }


    public function updateMessage(Request $request, Bid $bid)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);
    
        $userTeamId = auth()->user()->team->id;
    
        if ($userTeamId === $bid->buying_team_id) {
            // If the buying team is sending a message
            $bid->buying_team_message = $request->message;
        } elseif ($userTeamId === $bid->selling_team_id) {
            // If the selling team is responding
            $bid->selling_team_message = $request->message;
        } else {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
    
        $bid->save();
    
        return redirect()->route('bids.index')->with('success', 'Message sent successfully.');
    }
    

    

    // Accept a bid
    public function accept($id)
    {
        // Find the accepted bid
        $bid = Bid::findOrFail($id);
    
        // Remove all other bids for the same player
        Bid::where('player_id', $bid->player_id)
            ->where('id', '!=', $bid->id)  // Keep the accepted bid
            ->delete();
    
        // Mark this bid as accepted
        $bid->update(['status' => 'Accepted']);
    
        return redirect()->back()->with('success', 'Bid accepted!');
    }
    
    public function reject($id)
    {
        // Find and delete the rejected bid
        Bid::findOrFail($id)->delete();
    
        return redirect()->back()->with('success', 'Bid rejected and removed.');
    }
    
}