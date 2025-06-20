<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ensure the user is associated with a team
        $user = Auth::user();
    
        if (!$user->team_id) {
            return redirect()->back()->withErrors('You are not assigned to a team.');
        }
    
        // Retrieve the team object associated with the authenticated user
        $team = $user->team;  // This will give you the team object directly
    
        // Get all doctors for the team
        $doctors = Doctor::where('team_id', $team->id)->get();
    
        return view('team.doctor-management', compact('doctors', 'team'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ensure the team is correctly retrieved from the authenticated user
        $team = Auth::user()->team; // This defines the team associated with the authenticated user

        // If the user is not part of a team, redirect with an error message
        if (!$team) {
            return redirect()->route('team.match-management')->withErrors('You are not part of any team.');
        }

        return view('doctor.create', compact('team'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|string|max:255',
            'contact_info' => 'required|string|max:255',
        ]);
    
        // Ensure the user is authenticated and has a team_id
        if (!Auth::check() || is_null(Auth::user()->team_id)) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
    
        // Retrieve the team ID for the authenticated user
        $teamId = Auth::user()->team_id;
    
        try {
            // Create the doctor and associate them with the authenticated user's team
            $doctor = Doctor::create([
                'name' => trim($request->name),
                'specialization' => trim($request->specialization),
                'contact_info' => trim($request->contact_info),
                'team_id' => $teamId,
            ]);
    
            // Log the success
            \Log::info("Doctor created:", $doctor->toArray());
    
            // Redirect with a success message
            return redirect()->route('team.doctor-management')->with('success', 'Doctor added successfully!');
        } catch (\Exception $e) {
            // Log the error if something goes wrong
            \Log::error("Error creating doctor: " . $e->getMessage());
    
            // Redirect with an error message
            return redirect()->back()->with('error', 'Failed to add doctor. Please try again.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
/**
 * Show the form for editing the specified resource.
 */
// Controller Method
public function edit($id)
{
    $doctor = Doctor::findOrFail($id);  // Find the doctor by ID
    return response()->json($doctor);   // Return doctor data as JSON
}


/**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'specialization' => 'required|string|max:255',
        'contact_info' => 'required|string|max:255',
    ]);

    $doctor = Doctor::findOrFail($id);

    // Ensure the authenticated user belongs to the same team as the doctor
    $user = Auth::user();
    if (!$user->team_id || $doctor->team_id !== $user->team_id) {
        return redirect()->route('team.doctor-management')->withErrors('Unauthorized action.');
    }

    try {
        $doctor->update([
            'name' => $request->name,
            'specialization' => $request->specialization,
            'contact_info' => $request->contact_info,
        ]);

        return redirect()->route('team.doctor-management')->with('success', 'Doctor updated successfully!');
    } catch (\Exception $e) {
        \Log::error("Error updating doctor: " . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to update doctor. Please try again.');
    }
}





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the doctor by ID
        $doctor = Doctor::findOrFail($id);

        // Ensure the authenticated user is part of the team for this doctor
        if ($doctor->team_id != Auth::user()->team_id) {
            return redirect()->back()->with('error', 'You do not have permission to delete this doctor.');
        }

        try {
            // Delete the doctor
            $doctor->delete();

            // Log the success
            \Log::info("Doctor deleted:", $doctor->toArray());

            // Redirect with a success message
            return redirect()->route('team.doctor-management')->with('success', 'Doctor deleted successfully!');
        } catch (\Exception $e) {
            // Log the error if something goes wrong
            \Log::error("Error deleting doctor: " . $e->getMessage());

            // Redirect with an error message
            return redirect()->back()->with('error', 'Failed to delete doctor. Please try again.');
        }
    }
}
