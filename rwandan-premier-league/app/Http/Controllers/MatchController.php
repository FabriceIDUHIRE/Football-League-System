<?php

namespace App\Http\Controllers;

use App\Models\Matchs;
use App\Models\Team;
use App\Models\Stadium;
use App\Models\MatchCategory;
use Illuminate\Http\Request;
use App\Models\Referee;
use App\Models\MatchCommissioner;
use Illuminate\Support\Facades\Auth;


class MatchController extends Controller
{
    protected $table = 'match_categories'; // Ensure this matches your DB table name
    protected $fillable = ['name'];




    // Show list of matches
    public function index(Request $request)
    {
        // Fetch all categories for filtering
        $categories = MatchCategory::all();
    
        // Ensure categories exist before proceeding
        if ($categories->isEmpty()) {
            return redirect()->route('matches.index')->with('error', 'No match categories found! Please add categories first.');
        }
    
        // Retrieve matches based on selected category (if provided)
        $matches = Matchs::when($request->filled('category'), function ($query) use ($request) {
            return $query->where('match_category_id', $request->input('category'));
        })->get();
    
        // Fetch related data
        $stadiums = Stadium::all();
        $teams = Team::all();
        $mainReferees = Referee::where('type', 'Main Referee')->get();
        $assistantReferees = Referee::where('type', 'Assistant Referee')->get();
        $fourthReferees = Referee::where('type', 'Fourth Referee')->get();
        $matchCommissioners = MatchCommissioner::all();
    
        return view('matches.index', compact(
            'matches', 'stadiums', 'teams', 'categories',
            'mainReferees', 'assistantReferees', 'fourthReferees', 'matchCommissioners'
        ));
    }
    

    // Show a single match
    public function show($id)
    {
        // Find the match by ID
        $match = Matchs::with(['homeTeam', 'awayTeam', 'matchCategory', 'stadium', 'referee'])->findOrFail($id);

        // Check the user's role
        $user = auth()->user();
        if ($user->role === 'admin') {
            // Admin-specific logic (if needed)
        } elseif ($user->role === 'team_manager') {
            // Team manager-specific logic (if needed)
        }

        return view('match.details', compact('match'));
    }


    
    public function showDetails($id)
    {
        // Get the authenticated user
        $user = Auth::user();
    
        // Check if the user is associated with a team
        if (!$user->team) {
            // Handle the case where the user doesn't belong to a team
            return redirect()->route('team.match-management')->with('error', 'You are not associated with a team.');
        }
    
        // Get the user's team
        $team = $user->team;
    
        // Fetch the match details along with related data
        $match = Matchs::with([
            'homeTeam', 'awayTeam', 'matchCategory', 'stadium', 
            'referee', 'assistantReferee1', 'assistantReferee2', 
            'fourthReferee', 'matchCommissioner'
        ])->findOrFail($id);
    
        // Pass the match and team to the view
        return view('team.details', compact('match', 'team'));
    }
    
    
    

    // Show form to create a new match
    public function create()
    {
        $referees = Referee::all();
        $stadiums = Stadium::all();
        $teams = Team::all();
        $categories = MatchCategory::all();

        return view('matches.create', compact('referees', 'stadiums', 'teams', 'categories'));
    }

    // Store new match data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'match_date' => 'required|date',
            'stadium_id' => 'required|exists:stadiums,id',
            'referee_id' => 'required|exists:referees,id',
            'assistant_referee1_id' => 'required|exists:referees,id',
            'assistant_referee2_id' => 'required|exists:referees,id|different:assistant_referee1_id',
            'fourth_referee_id' => 'nullable|exists:referees,id',
            'match_commissioner_id' => 'required|exists:match_commissioners,id',
            'home_team_id' => 'required|exists:teamss,id',
            'away_team_id' => 'required|exists:teamss,id|different:home_team_id',
            'match_category_id' => 'required|exists:match_categories,id',
        ]);
        
    
        // Create a new match
// Create a new match
$match = Matchs::create([
    'match_date' => $validated['match_date'],
    'stadium_id' => $validated['stadium_id'],
    'referee_id' => $validated['referee_id'],
    'assistant_referee1_id' => $validated['assistant_referee1_id'],
    'assistant_referee2_id' => $validated['assistant_referee2_id'],
    'fourth_referee_id' => $validated['fourth_referee_id'] ?? null,
    'match_commissioner_id' => $validated['match_commissioner_id'],
    'home_team_id' => $validated['home_team_id'],
    'away_team_id' => $validated['away_team_id'],
    'match_category_id' => $validated['match_category_id'],
]);

return redirect()->route('matches.index')->with('success', 'Match registered successfully!');


    
        // Attach assistant referees
        $match->assistantReferees()->attach($validated['assistant_referees']);
    
        return redirect()->route('matches.index')->with('success', 'Match registered successfully!');
    }
    

    // Filter Matches
    public function filterByCategory($categoryId)
    {
        // Retrieve matches based on the category
        $matches = Matchs::where('match_category_id', $categoryId)->get();

        // Return a partial view with the filtered matches
        return view('matches.partials.matches-list', ['matches' => $matches]);
    }

    // Edit an existing match
    public function edit($id)
    {
        $match = Matchs::findOrFail($id);
        $stadiums = Stadium::all();
        $referees = Referee::all();
        $teams = Team::all();
        $categories = MatchCategory::all();

        return view('matches.edit', compact('match', 'stadiums', 'referees', 'teams', 'categories'));
    }

    // Update match details
    public function update(Request $request, $id)
    {
        // Validate input
        $validated = $request->validate([
            'match_date' => 'required|date',
            'stadium_id' => 'required|exists:stadiums,id',
            'referee_id' => 'required|exists:referees,id',
            'home_team_id' => 'required|exists:teamss,id',
            'away_team_id' => 'required|exists:teamss,id|different:home_team_id',
            'category_id' => 'required|exists:match_categories,id',
        ]);

        // Find the match by ID
        $match = Matchs::findOrFail($id);

        // Update the match with validated data
        $match->update([
            'match_date' => $validated['match_date'],
            'stadium_id' => $validated['stadium_id'],
            'referee_id' => $validated['referee_id'],
            'home_team_id' => $validated['home_team_id'],
            'away_team_id' => $validated['away_team_id'],
            'match_category_id' => $validated['category_id'],
        ]);

        return redirect()->route('matches.index')->with('success', 'Match updated successfully!');
    }


    public function MatchEdit($id)
    {
        // Fetch the match and all necessary data for editing
        $match = Matchs::with([
            'homeTeam',
            'awayTeam',
            'matchCategory',
            'stadium',
            'referee',
            'assistantReferee1',
            'assistantReferee2',
            'fourthReferee',
            'matchCommissioner'
        ])->findOrFail($id);
        
        // Fetch all related entities
        $teams = Team::all();
        $categories = MatchCategory::all();
        $stadiums = Stadium::all();
        $referees = Referee::all();
        $commissioners = MatchCommissioner::all(); // ✅ Add this line
    
        // Pass everything to the view
        return view('matches.edit', compact(
            'match', 
            'teams', 
            'categories', 
            'stadiums', 
            'referees', 
            'commissioners' // ✅ Include here
        ));
    }
    

public function MatchUpdate(Request $request, $id)
{
    // Validate the request data
    $validated = $request->validate([
        'home_team_id' => 'required|exists:teams,id',
        'away_team_id' => 'required|exists:teams,id',
        'match_date' => 'required|date',
        'stadium_id' => 'required|exists:stadiums,id',
        'referee_id' => 'required|exists:referees,id',
        'assistant_referee_1_id' => 'nullable|exists:referees,id',
        'assistant_referee_2_id' => 'nullable|exists:referees,id',
        'fourth_referee_id' => 'nullable|exists:referees,id',
        'match_commissioner_id' => 'required|exists:referees,id',
    ]);

    // Fetch the match and update it
    $match = Matchs::findOrFail($id);
    $match->update($validated);

    // Redirect back with success message
    return redirect()->route('matches.edit', $match->id)->with('success', 'Match updated successfully!');
}




    // Delete a match
    public function destroy($id)
    {
        $match = Matchs::findOrFail($id);

        // Delete the match
        $match->delete();

        // Redirect with a success message
        return redirect()->route('matches.index')->with('success', 'Match deleted successfully!');
    }

    // Show matches for a specific team
    public function showMatches()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Check if the user is an admin or team manager
        if ($user->hasRole('Admin')) {
            // Admin sees all matches
            $matches = Matchs::with(['homeTeam', 'awayTeam', 'category', 'stadium'])->get();
        } else {
            // Team manager sees only matches related to their team
            $matches = $user->team->matches()->with(['homeTeam', 'awayTeam', 'category', 'stadium'])->get();
        }

        return view('team_dashboard.match-management', compact('matches'));
    }

    public function fixtures()
    {
        $matches = Matchs::all(); // Fetch all matches
        return view('team.fixtures', compact('matches'));
    }
}
