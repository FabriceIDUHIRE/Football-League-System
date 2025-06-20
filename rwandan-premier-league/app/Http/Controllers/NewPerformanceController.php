<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Performance; 
use App\Models\Team;



class NewPerformanceController extends Controller
{


   

    public function index()
    {
        // Get the currently authenticated team (this assumes you have a way of identifying the team in your session/authentication)
        $teamId = auth()->user()->team_id; // This is just an example, adjust it based on how you manage team authentication
        $team = Team::find($teamId);
    
        // Fetch the performance data for the logged-in team only
        $performanceData = Performance::where('team_id', $teamId)->get();
    
        return view('team.performance', compact('performanceData','team'));
    }



    // Show the Edit Form
    public function edit($id)
    {
        $performance = Performance::find($id);

        if (!$performance) {
            return redirect()->route('team.performance')->with('error', 'Performance not found');
        }

        return view('team.performance_edit', compact('performance'));
    }

    public function update(Request $request, $id)
    {
        $performance = Performance::find($id);
    
        if (!$performance) {
            return redirect()->route('team.performance')->with('error', 'Performance not found');
        }
    
        
    
        $request->validate([
            'wins' => 'required|integer',
            'losses' => 'required|integer',
            'draws' => 'required|integer',
            'goals_scored' => 'required|integer',
            'goals_conceded' => 'required|integer',
            'yellow_cards' => 'required|integer',
            'red_cards' => 'required|integer',
        ]);
    
        $performance->update($request->all());
    
        return redirect()->route('team.performance')->with('success', 'Performance updated successfully');
    }
    
}

    

