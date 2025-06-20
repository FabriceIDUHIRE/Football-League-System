<?php

namespace App\Http\Controllers;

use App\Models\Manager; // Import the Manager model
use App\Models\Team;    // Import the Team model
use Illuminate\Http\Request;

class ManagerController extends Controller
{



    
    // Display the form for creating a new manager
    public function create()
    {
        $teams = Team::all(); // Fetch all teams
        return view('managers.create', compact('teams')); // Pass teams to the view
    }

    // Store a newly created manager in the database
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:managers,email', // Ensure unique email
            'phone' => 'nullable|string|max:20',              // Phone is optional
            'team_id' => 'required|exists:teams,id',           // Ensure the team exists
        ]);

        // Create the manager
        Manager::create($validatedData);

        // Redirect to the teams page with a success message
        return redirect()->route('teams.index')->with('success', 'Manager added successfully!');
    }

    // Edit an existing manager (optional if needed later)
    public function edit($id)
    {
        $manager = Manager::findOrFail($id); // Find manager or fail
        $teams = Team::all();               // Fetch all teams for dropdown
        return view('managers.edit', compact('manager', 'teams')); // Pass manager and teams to the edit view
    }

    // Update the manager details (optional if needed later)
    public function update(Request $request, $id)
    {
        // Validate updated data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:managers,email,' . $id, // Exclude current manager from unique check
            'phone' => 'nullable|string|max:20',
            'team_id' => 'required|exists:teams,id',
        ]);

        // Find and update manager
        $manager = Manager::findOrFail($id);
        $manager->update($validatedData);

        // Redirect with success message
        return redirect()->route('teams.index')->with('success', 'Manager updated successfully!');
    }

    // Delete a manager (optional if needed later)
    public function destroy($id)
    {
        $manager = Manager::findOrFail($id); // Find manager or fail
        $manager->delete();                  // Delete the manager
        return redirect()->route('teams.index')->with('success', 'Manager deleted successfully!');
    }
}
