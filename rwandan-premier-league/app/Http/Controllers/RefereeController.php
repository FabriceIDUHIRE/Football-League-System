<?php

namespace App\Http\Controllers;

use App\Models\Referee;
use Illuminate\Http\Request;

class RefereeController extends Controller
{



    
    // Display a listing of referees
    public function index()
    {
        $referees = Referee::paginate(10);
        return view('referees.index', compact('referees'));
    }

    // Show the form for creating a new referee
    public function create()
    {
        return view('referees.create');
    }

    // Store a newly created referee
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'qualification' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|string|in:central,assistant,fourth',  // Add validation for 'type'
        ]);
    
        // Handle the file upload for profile photo
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/profile_photos', $filename);
            $validatedData['profile_photo'] = $filename;
        }
    
        // Create a new referee with the validated data
        Referee::create($validatedData);
    
        // Redirect with a success message
        return redirect()->route('referees.index')->with('success', 'Referee added successfully!');
    }
    

    // Display the specified referee
    public function show($id)
    {
        $referee = Referee::findOrFail($id);
        return view('referees.show', compact('referee'));
    }

    // Show the form for editing a referee
    public function edit($id)
    {
        $referee = Referee::findOrFail($id);
        return view('referees.edit', compact('referee'));
    }

    // Update a referee
    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'qualification' => 'nullable|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Find the referee by ID
        $referee = Referee::findOrFail($id);

        // Handle profile photo upload
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('referee_photos', 'public');
            $validatedData['profile_photo'] = $path;
        }

        // Update referee data
        $referee->update($validatedData);

        // Redirect with a success message
        return redirect()->route('referees.index')->with('success', 'Referee updated successfully!');
    }

    // Delete a referee
    public function destroy($id)
    {
        // Find the referee by ID
        $referee = Referee::findOrFail($id);

        // Delete the referee
        $referee->delete();

        // Redirect with a success message
        return redirect()->route('referees.index')->with('success', 'Referee deleted successfully!');
    }
}
