<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Player;
use App\Models\Team;

class ContractController extends Controller
{

    
    // Display all contracts
    public function index()
    {
        // Retrieve the team object for the logged-in user
        $team = auth()->user()->team;
        
        // Only retrieve contracts belonging to the logged-in team
        $contracts = Contract::with(['player', 'team'])
            ->where('team_id', $team->id)  // Filter by the logged-in team's ID
            ->get();
    
        return view('contracts.index', compact('contracts', 'team'));
    }


    
    
    

    // Show contract creation form
    public function create()
    {
        // Retrieve the team object for the logged-in user
        $team = auth()->user()->team;
    
        // Get players belonging to the logged-in team
        $players = Player::where('team_id', $team->id)->get();
    
        // Fetch all teams for the dropdown (for 'to_team_id')
        $teams = Team::all();
    
        return view('contracts.create', compact('players', 'teams', 'team'));
    }
    


    public function getPlayerContract($playerId)
{
    $player = Player::with('contract')->findOrFail($playerId);
    return response()->json($player->contract); // Return the contract data if available
}


    // Store contract in database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'player_id' => 'required|exists:players,id',
            'start_date' => 'required|date|date_format:Y-m-d',
            'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
            'salary' => 'required|numeric|min:0',
        ]);
    
        // Proceed to save the contract if validation passes
        $contract = new Contract();
        $contract->player_id = $request->player_id;
        $contract->start_date = $request->start_date;
        $contract->end_date = $request->end_date;
        $contract->salary = $request->salary;
        $contract->contract_status = 'active'; // Default status
        $contract->team_id = auth()->user()->team_id; // Automatically set the team ID to the logged-in team's ID
    
        $contract->save();
    
        return redirect()->route('contracts.index')->with('success', 'Contract successfully added.');
    }
    
    
    
    
    
    

    // Show contract edit form
    public function edit(Contract $contract)
    {
        $players = Player::all();
        $teams = Team::all();
        return view('contracts.edit', compact('contract', 'players', 'teams'));
    }

    // Update contract details
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'player_id' => 'required|exists:players,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'salary' => 'required|numeric',
            'contract_status' => 'required|string|in:active,terminated,expired', // Validation for contract_status
        ]);
    
        $contract = Contract::findOrFail($id);
        $contract->update($validated);
    
        return redirect()->route('contracts.index')->with('success', 'Contract updated successfully.');
    }
    
    


    public function terminate($id)
    {
        $contract = Contract::findOrFail($id);
    
        // Only allow termination of active contracts
        if ($contract->contract_status == 'active') {
            $contract->contract_status = 'terminated';
            $contract->save();
        }
    
        return redirect()->route('contracts.index')->with('success', 'Contract terminated successfully.');
    }
    
    
    

    // Delete contract
    public function destroy(Contract $contract)
    {
        $contract->delete();
        return redirect()->route('contracts.index')->with('success', 'Contract deleted successfully.');
    }
}
