<?php

namespace App\Http\Controllers;

use App\Models\LoanDeal;
use App\Models\Team;
use App\MOdels\TransferWindow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanDealController extends Controller
{
    // Function to display loan deals specific to the logged-in team
    public function index()
    {
        // Fetch the logged-in user's team ID
        $teamId = Auth::user()->team_id;
      
        // Fetch loan deals where the logged-in team is the creating team (team_id)
        $loanDealsCreated = LoanDeal::where('team_id', $teamId)->get();
      
        // Fetch loan deals where the logged-in team is the receiving team (receiving_team_id)
        $loanDealsReceived = LoanDeal::where('receiving_team_id', $teamId)->get();
      
        // Fetch the team data
        $team = Team::find($teamId);
      
        // Fetch the players of the logged-in team (for creating loan deals)
        $players = $team->players;
      
        // Fetch the current transfer window
        $window = TransferWindow::latest()->first();
        $isOpen = $window ? $window->is_open : false; // Check if the window is open
      
        // Fetch all teams (for the receiving team dropdown)
        $teams = Team::all();
      
        // Pass loanDealsCreated, loanDealsReceived, team, players, isOpen, and teams to the view
        return view('loan_deals.index', compact('loanDealsCreated', 'loanDealsReceived', 'team', 'players', 'isOpen', 'teams'));
    }
    
    
    
    
    
    
    
    // Function to show the form for creating a loan deal
    public function create()
    {
        // Get the logged-in user's team ID
        $teamId = Auth::user()->team_id;

        // Pass the team ID to the view so it can be used in the form
        return view('loan_deals.create', compact('teamId'));
    }

    // Function to handle loan deal creation
    public function createLoanDeal(Request $request)
    {
        $request->merge([
            'has_buy_clause' => $request->has('has_buy_clause') ? 1 : 0,
        ]);
    
        // Validate including receiving_team_id
        $request->validate([
            'player_id' => 'required',
            'loan_start_date' => 'required|date',
            'loan_end_date' => 'required|date|after:loan_start_date',
            'has_buy_clause' => 'boolean',
            'buy_clause_fee' => 'nullable|numeric|min:0',
            'receiving_team_id' => 'required|exists:teams,id',
        ]);
    
        // Create loan deal with receiving_team_id
        LoanDeal::create([
            'player_id' => $request->player_id,
            'team_id' => Auth::user()->team_id,
            'receiving_team_id' => $request->receiving_team_id,
            'loan_start_date' => $request->loan_start_date,
            'loan_end_date' => $request->loan_end_date,
            'has_buy_clause' => $request->has_buy_clause,
            'buy_clause_fee' => $request->buy_clause_fee,
        ]);
    
        return redirect()->route('loan-deals.index')->with('success', 'Loan deal created successfully!');
    }



    public function update(Request $request, $id)
{
    $loanDeal = LoanDeal::findOrFail($id);
    $loanDeal->update([
        'loan_start_date' => $request->loan_start_date,
        'loan_end_date' => $request->loan_end_date,
        'has_buy_clause' => $request->has_buy_clause,
        'buy_clause_fee' => $request->buy_clause_fee,
        'receiving_team_id' => $request->receiving_team_id,
    ]);

    return redirect()->back()->with('success', 'Loan Deal updated successfully.');
}

public function destroy($id)
{
    $loanDeal = LoanDeal::findOrFail($id);
    $loanDeal->delete();

    return redirect()->back()->with('success', 'Loan Deal deleted successfully.');
}

    
}    
