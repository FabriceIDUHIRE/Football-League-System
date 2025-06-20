<?php

namespace App\Http\Controllers;

use App\Models\Stadium;
use Illuminate\Http\Request;

class StadiumController extends Controller
{



    
    // Display all stadiums
    public function index()
    {
        // Fetch paginated stadiums
        $stadiums = Stadium::paginate(10);

        // Pass the data to the view
        return view('stadiums.index', compact('stadiums'));
    }

    // Show form to create a new stadium
    public function create()
    {
        return view('stadiums.create'); // Return the view where the user can add a new stadium
    }

    // Store a newly created stadium in the database
    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer|min:0',
        ]);

        // Create the stadium
        Stadium::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('stadiums.index')->with('success', 'Stadium added successfully!');
    }

    // Display a specific stadium
    public function show($id)
    {
        $stadium = Stadium::findOrFail($id); // Retrieve the stadium by its ID
        return view('stadiums.show', compact('stadium')); // Pass the stadium data to the view
    }

    // Show form to edit a specific stadium
    public function edit($id)
    {
        $stadium = Stadium::findOrFail($id); // Find the stadium by ID or fail
        return view('stadiums.edit', compact('stadium')); // Pass the stadium to the view
    }

    // Update a specific stadium
    public function update(Request $request, $id)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:0',
        ]);

        // Find and update the stadium
        $stadium = Stadium::findOrFail($id);
        $stadium->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('stadiums.index')->with('success', 'Stadium updated successfully.');
    }

    // Delete a specific stadium
    public function destroy($id)
    {
        $stadium = Stadium::findOrFail($id); // Find the stadium by ID
        $stadium->delete(); // Delete the stadium

        // Redirect to the index page with a success message
        return redirect()->route('stadiums.index')->with('success', 'Stadium deleted successfully!');
    }
}
