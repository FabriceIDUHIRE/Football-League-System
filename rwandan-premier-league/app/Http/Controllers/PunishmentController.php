<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Models\Coach;
use App\Models\Referee;
use App\Models\Team;
use App\Models\Punishment;





class PunishmentController extends Controller
{



    
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $punishments = Punishment::with(['player', 'coach', 'team', 'referee'])->get();
    
    //dd($punishments); // Check if names are retrieved properly
    return view('punishments.index', compact('punishments'));
}

    
    
    
    
    
    
    
    
    
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $players = \App\Models\Player::select('id', 'name')->get();
        $coaches = \App\Models\Coach::select('id', 'name')->get();
        $teams = \App\Models\Team::select('id', 'name')->get();
        $referees = \App\Models\Referee::select('id', 'name')->get();
    
        return view('punishments.create', compact('players', 'coaches', 'teams', 'referees'));
    }
    
    
    
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|in:player,coach,team,referee',
            'user_id' => 'required', // This is the dynamic field that holds the selected entity's ID
            'type' => 'required|string|max:255',
            'reason' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);
        
        $punishment = new Punishment();
        $punishment->type = $request->type;
        $punishment->reason = $request->reason;
        $punishment->start_date = $request->start_date;
        $punishment->end_date = $request->end_date;
    
        // Use the posted role to assign the correct foreign key:
        if ($request->role == 'team') {
            $punishment->team_id = $request->user_id;
        } elseif ($request->role == 'player') {
            $punishment->player_id = $request->user_id;
        } elseif ($request->role == 'coach') {
            $punishment->coach_id = $request->user_id;
        } elseif ($request->role == 'referee') {
            $punishment->referee_id = $request->user_id;
        }
    
        $punishment->save();
    
        return redirect()->route('punishments.index')->with('success', 'Punishment created successfully.');
    }
    
    
    
    
    
    
    
    
    
    
    
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $punishment = Punishment::findOrFail($id);
        return view('punishments.edit', compact('punishment'));
    }
    
    public function terminate($id)
    {
        $punishment = Punishment::findOrFail($id);
        $punishment->end_date = now();  // Set end date to current date to terminate punishment
        $punishment->save();
    
        return redirect()->route('punishments.index')->with('success', 'Punishment terminated.');
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string',
            'reason' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
        ]);
    
        $punishment = Punishment::findOrFail($id);
        $punishment->update($request->all());
    
        return redirect()->route('punishments.index')->with('success', 'Punishment updated successfully.');
    }
    

/**
 * Remove the specified resource from storage.
 */
public function destroy(string $id)
{
    $punishment = Punishment::findOrFail($id); // Find the punishment by ID
    $punishment->delete(); // Delete the punishment

    return redirect()->route('punishments.index')->with('success', 'Punishment deleted successfully.');
}

}
