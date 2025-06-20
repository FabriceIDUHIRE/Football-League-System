<?php

namespace App\Http\Controllers;

use App\Models\Staff; // Import the Staff model
use Illuminate\Http\Request;

class StaffController extends Controller
{

    
    public function index()
    {
        $user = auth()->user();
        $team = $user->team; // Get the team associated with the logged-in user
    
        if (!$team) {
            abort(404, 'Team not found'); // Prevent errors if the user has no team
        }
    
        $staff = Staff::where('team_id', $team->id)->get();
        $staffCount = $staff->count(); // Count the staff for the logged-in user's team
    
        return view('team.partials.staff', compact('staff', 'staffCount', 'team'));
    }
    
    
    
    // Other methods like store, update, delete can be added as needed

    public function store(Request $request)
{
    $user = auth()->user();

    Staff::create([
        'name' => $request->name,
        'position' => $request->position,
        'team_id' => $user->team->id,
    ]);

    return redirect()->route('teams.staff')->with('success', 'Staff added successfully!');
}

public function update(Request $request, Staff $staff)
{
    $staff->update([
        'name' => $request->name,
        'position' => $request->position,
    ]);

    return redirect()->route('teams.staff')->with('success', 'Staff updated successfully!');
}

public function destroy(Staff $staff)
{
    $staff->delete();
    return redirect()->route('teams.staff')->with('success', 'Staff deleted successfully!');
}

}

