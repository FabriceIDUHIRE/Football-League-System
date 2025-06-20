<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Injury;
use App\Models\Player;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class InjuryController extends Controller
{



    
    public function index()
    {
        // Retrieve the team object for the logged-in user
        $team = auth()->user()->team;
    
        // Fetch injuries related to players in the logged-in team
        $injuries = Injury::whereHas('player', function ($query) use ($team) {
            $query->where('team_id', $team->id);
        })
        ->with('player', 'doctor')  // Eager load both player and doctor relationships
        ->get();
    
        // Get doctors and players associated with the team
        $doctors = Doctor::where('team_id', $team->id)->get();
        $players = Player::where('team_id', $team->id)->get();
    
        return view('injuries.index', compact('injuries', 'players', 'doctors', 'team'));
    }
    



    // Store a new injury record
    public function store(Request $request)
    {
        $request->validate([
            'player_id' => 'required|exists:players,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'injury_type' => 'required|string',
            'severity' => 'required|string',
            'injury_date' => 'required|date',
            'expected_recovery_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);
    
        // Retrieve the team object for the logged-in user
        $team = auth()->user()->team;
    
        // If doctor_id is not passed, use null
        $doctorId = $request->doctor_id ?? null;
    
        // Create the injury record and associate it with the logged-in team
        Injury::create([
            'player_id' => $request->player_id,
            'doctor_id' => $doctorId,
            'injury_type' => $request->injury_type,
            'severity' => $request->severity,
            'injury_date' => $request->injury_date,
            'expected_recovery_date' => $request->expected_recovery_date,
            'notes' => $request->notes,
            'team_id' => $team->id,  // Automatically set team_id from the logged-in user
        ]);
    
        return redirect()->route('injuries.index')->with('success', 'Injury added successfully!');
    }
    
    

    // Update an existing injury record
    public function update(Request $request, $id)
    {
        $request->validate([
            'player_id' => 'required|exists:players,id',
            'doctor_id' => 'nullable|exists:doctors,id',
            'injury_type' => 'required|string',
            'severity' => 'required|string',
            'injury_date' => 'required|date',
            'expected_recovery_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);
    
        // Retrieve the injury by ID
        $injury = Injury::findOrFail($id);
    
        // Retrieve the team object for the logged-in user
        $team = auth()->user()->team;
    
        // If no doctor is assigned, use null
        $doctorId = $request->doctor_id ?? null;
    
        // Update the injury record and associate it with the logged-in team
        $injury->update([
            'player_id' => $request->player_id,
            'doctor_id' => $doctorId,
            'injury_type' => $request->injury_type,
            'severity' => $request->severity,
            'injury_date' => $request->injury_date,
            'expected_recovery_date' => $request->expected_recovery_date,
            'notes' => $request->notes,
            'team_id' => $team->id,  // Automatically set team_id from the logged-in user
        ]);
    
        return redirect()->route('injuries.index')->with('success', 'Injury updated successfully!');
    }
    

    // Delete an injury record
    public function destroy($id)
    {
        // Retrieve the injury by ID
        $injury = Injury::findOrFail($id);
    
        // Delete the injury
        $injury->delete();
    
        // Redirect back with a success message
        return redirect()->route('injuries.index')->with('success', 'Injury deleted successfully!');
    }
    
}
