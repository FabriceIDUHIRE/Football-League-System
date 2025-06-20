<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class SponsorController extends Controller
{



    
    public function index()
    {
        // Fetch sponsors based on the current user's team_id
        $sponsors = Sponsor::where('team_id', Auth::user()->team_id)->get();
        
        // Fetch the team information associated with the current user
        $team = Auth::user()->team; // Assuming the `team` relationship exists in the User model
        
        return view('team.sponsorship', compact('sponsors', 'team'));
    }
    

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'sponsor_name' => 'required|string|max:255',
            'contract_start_date' => 'required|date',
            'contract_end_date' => 'required|date|after:contract_start_date',
            'amount' => 'required|numeric|min:1000',
        ]);
        
        // Store the sponsor and associate it with the logged-in user's team_id
        Sponsor::create([
            'sponsor_name' => $request->sponsor_name,
            'contract_start_date' => $request->contract_start_date,
            'contract_end_date' => $request->contract_end_date,
            'amount' => $request->amount,
            'team_id' => Auth::user()->team_id,  // Dynamically assign the logged-in team's ID
        ]);
        
        // Redirect back with success message
        return redirect()->back()->with('success', 'Sponsor Added Successfully!');
    }



    public function destroy($id)
{
    // Find the sponsor by its ID
    $sponsor = Sponsor::findOrFail($id);

    // Delete the logo image from the storage if it exists
    if ($sponsor->image_path) {
        Storage::disk('public')->delete($sponsor->image_path);
    }

    // Delete the sponsor record from the database
    $sponsor->delete();

    // Redirect back to the sponsors page with a success message
    return redirect()->route('team.sponsorship')->with('success', 'Sponsor deleted successfully');
}

    
    
    
    
}
