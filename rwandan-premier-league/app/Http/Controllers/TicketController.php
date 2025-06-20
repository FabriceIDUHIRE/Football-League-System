<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Team;

use Illuminate\Http\Request;

class TicketController extends Controller
{



    
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $teams = Team::all();
        return view('tickets.create', compact('teams'));

        dd($teams);
    }

    public function store(Request $request)
    {
        $request->validate([
            'event' => 'required|string|max:255',
            'price' => 'required|numeric',
            'seats' => 'required|integer',
            'home_team_id' => 'required|exists:teams,id',
            'away_team_id' => 'required|exists:teams,id|different:home_team_id',
            'status' => 'required|in:Active,Sold Out',
        ], [
            'home_team_id.exists' => 'Please select a valid home team.',
            'away_team_id.different' => 'Home and away teams cannot be the same.',
        ]);
        
    
        Ticket::create($request->all());
    
        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }
    
    


public function edit($id)
{
    $ticket = Ticket::findOrFail($id); // Fetch the ticket by ID
    $teams = Team::all(); // Fetch all teams (replace with 'teamss' if needed)
    
    return view('tickets.edit', compact('ticket', 'teams'));
}



    

public function update(Request $request, $id)
{
    $ticket = Ticket::findOrFail($id);
    $ticket->update([
        'event' => $request->event,
        'home_team_id' => $request->home_team_id,
        'away_team_id' => $request->away_team_id,
        'price' => $request->price,
        'seats' => $request->seats,
        'status' => $ticket->status, // you can update status if needed
    ]);

    return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully!');
}




}
