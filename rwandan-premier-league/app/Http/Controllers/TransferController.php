<?php

namespace App\Http\Controllers;

use App\Models\PlayerTransfer;
use App\Models\Contract; // Include the Contract model
use App\Models\Player;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\TransferWindow;

class TransferController extends Controller
{






    // Display all transfers
    public function index()
    {
        $user = auth()->user();
        $teamId = $user->team_id;
    
        // Ensure the user is associated with a team
        if (!$teamId) {
            return redirect()->back()->withErrors('You are not assigned to a team.');
        }
    
        // Retrieve the full team object
        $team = $user->team;
    
        // Get the transfer window status (assuming there's a single active window)
        $transferWindow = TransferWindow::where('is_open', true)->first();
        $isOpen = $transferWindow ? true : false;
    
        // Fetch transfers related to the logged-in team
        $transfers = PlayerTransfer::where(function ($query) use ($teamId) {
            $query->where('to_team_id', $teamId)
                  ->orWhere('from_team_id', $teamId);
        })->get();
    
        // Pass the team object to the view for more flexibility
        return view('transfers.index', compact('transfers', 'isOpen', 'team'));
    }
    
    

    // Show create transfer form
    public function create()
    {
        $loggedTeamId = auth()->user()->team_id; // Get logged-in team's ID
    
        // Retrieve the team object associated with the logged-in user
        $team = auth()->user()->team;
    
        // Fetch only players that belong to the logged-in team
        $players = Player::where('team_id', $loggedTeamId)->get();
    
        // Fetch all teams for the dropdown (for 'to_team_id')
        $teams = Team::all();
    
        // Get the latest transfer window status
        $window = TransferWindow::latest()->first();
        $isOpen = $window ? $window->is_open : false;
    
        // Pass the team object to the view, in addition to the other data
        return view('transfers.create', compact('players', 'teams', 'team', 'loggedTeamId', 'isOpen'));
    }
    
    
    
    

    // Store new transfer data
// Store new transfer data
public function store(Request $request)
{
    // Validate request
    $request->validate([
        'player_id' => 'required|exists:players,id',
        'from_team_id' => 'required|exists:teamss,id',
        'to_team_id' => 'required|exists:teamss,id|different:from_team_id',
        'transfer_fee' => 'nullable|numeric',
        'contract_start_date' => 'required|date',
        'contract_end_date' => 'required|date|after:contract_start_date',
        'transfer_date' => 'required|date',
        'contract_duration' => 'required|integer',
    ]);

    // Create transfer request with status 'pending'
    $transfer = PlayerTransfer::create([
        'player_id' => $request->player_id,
        'from_team_id' => $request->from_team_id,
        'to_team_id' => $request->to_team_id,
        'transfer_fee' => $request->transfer_fee,
        'contract_start_date' => $request->contract_start_date,
        'contract_end_date' => $request->contract_end_date,
        'transfer_date' => $request->transfer_date,
        'status' => 'pending',
        'notified' => false,
    ]);

    return redirect()->route('transfers.index')->with('success', 'Transfer request sent. Awaiting approval.');
}


// In TransferController, inside the method to show the transfer details
public function show($id)
{
    $transfer = PlayerTransfer::findOrFail($id);
    
    $teamId = auth()->user()->team_id;
    
    // Only allow access if the team is involved in the transfer
    if ($transfer->from_team_id !== $teamId && $transfer->to_team_id !== $teamId) {
        return redirect()->route('transfers.index')->with('error', 'You are not authorized to view this transfer.');
    }

    return view('transfers.show', compact('transfer'));
}










public function approveTransfer($id)
{
    $transfer = PlayerTransfer::findOrFail($id);
    
    // Check if logged-in team is the receiving team
    if (auth()->user()->team_id !== $transfer->to_team_id) {
        return redirect()->route('transfers.index')->with('error', 'You are not authorized to approve this transfer.');
    }

    // Update transfer status
    $transfer->update(['status' => 'approved']);

    // Move player to the new team
    Player::where('id', $transfer->player_id)->update(['team_id' => $transfer->to_team_id]);

    return redirect()->route('transfers.index')->with('success', 'Transfer approved successfully!');
}

public function rejectTransfer($id)
{
    $transfer = PlayerTransfer::findOrFail($id);

    // Check if logged-in team is the receiving team
    if (auth()->user()->team_id !== $transfer->to_team_id) {
        return redirect()->route('transfers.index')->with('error', 'You are not authorized to reject this transfer.');
    }

    // Update transfer status
    $transfer->update(['status' => 'rejected']);

    return redirect()->route('transfers.index')->with('success', 'Transfer rejected successfully.');
}



    
}
