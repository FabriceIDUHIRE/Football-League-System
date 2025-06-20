<?php

namespace App\Http\Controllers;

use App\Models\Matchs;  
use App\Models\Team;
use App\Models\Stadium;
use App\Models\MatchCategory;


use Illuminate\Http\Request;

class FixtureController extends Controller
{



    
    public function index()
    {
        $user = auth()->user();
    
        
        if (!$user || !$user->team_id) {
            abort(403, 'You are not associated with any team.');
        }
    
        $teamId = $user->team_id;
    
        
        $fixtures = Matchs::with(['homeTeam', 'awayTeam', 'stadium'])
            ->where(function ($query) use ($teamId) {
                $query->where('home_team_id', $teamId)
                      ->orWhere('away_team_id', $teamId);
            })
            ->orderBy('match_date', 'asc')
            ->get();
    
        return view('fixtures.index', compact('fixtures'));
    }
    
    

    
    

    // Show the form for creating a new fixture
    public function create()
{
    $teams = Team::all(); 
    $stadiums = Stadium::all();
    $categories = MatchCategory::all();
    return view('fixtures.create', compact('teams', 'stadiums', 'categories'));
}


    // Store a newly created fixture in the database
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'home_team_id' => 'required|exists:teamss,id',
            'away_team_id' => 'required|exists:teamss,id|different:home_team_id',
            'stadium_id' => 'required|exists:stadiums,id',
            'match_category_id' => 'required|exists:match_categories,id',
            'match_date' => 'required|date',
        ]);
    
        // Ensure the logged-in user is associated with either the home or away team
        $user = auth()->user();
        if ($user->team_id != $request->home_team_id && $user->team_id != $request->away_team_id) {
            abort(403, 'You can only add fixtures for your own team.');
        }
    
        // Store the fixture data
        Fixture::create([
            'home_team_id' => $request->home_team_id,
            'away_team_id' => $request->away_team_id,
            'stadium_id' => $request->stadium_id,
            'match_category_id' => $request->match_category_id,
            'match_date' => $request->match_date,
        ]);
    
        return redirect()->route('fixtures.index')->with('success', 'Fixture added successfully.');
    }
    


    // Display the details of a specific fixture
    public function show(Fixture $fixture)
    {
        // Load home and away team relationships
        $fixture->load(['homeTeam', 'awayTeam']);
        return view('fixtures.show', compact('fixture'));
    }

    // Show the form for editing a fixture
    public function edit(Fixture $fixture)
    {
        $teams = Team::all(); // Fetch all teams for selection
        return view('fixtures.edit', compact('fixture', 'teams'));
    }

    // Update an existing fixture in the database
    public function update(Request $request, Fixture $fixture)
    {
        // Validate updated data
        $request->validate([
            'home_team_id' => 'required|exists:teams,id|different:away_team_id', // Home and away teams must differ
            'away_team_id' => 'required|exists:teams,id',
            'match_date' => 'required|date|after_or_equal:today', // Prevent past dates
            'venue' => 'required|string|max:255',
        ]);

        // Update fixture details
        $fixture->update($request->all());

        // Redirect with a success message
        return redirect()->route('fixtures.index')->with('success', 'Fixture updated successfully!');
    }

    // Delete a fixture from the database
    public function destroy(Fixture $fixture)
    {
        // Delete the fixture
        $fixture->delete();

        // Redirect with a success message
        return redirect()->route('fixtures.index')->with('success', 'Fixture deleted successfully!');
    }
}
