<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matchs;
use App\Models\Player;
use App\Models\Lineup;
use Illuminate\Support\Facades\Auth;

class LineupController extends Controller
{
    // Show available matches & lineup form in one view
    public function index()
    {
        // Get the logged-in user's team
        $team = auth()->user()->team;
    
        // Get matches involving the user's team
        $matches = Matchs::where('home_team_id', $team->id)->orWhere('away_team_id', $team->id)->get();
    
        // Get players of the logged-in user's team
        $players = Player::where('team_id', $team->id)->get();
    
        // Get lineups that belong to the user's team
        $lineups = Lineup::with(['players'])
                        ->where('team_id', $team->id) // Filter lineups by team
                        ->get();
    
        return view('lineup.index', compact('matches', 'players', 'lineups', 'team'));
    }
    

    // Store the lineup
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'match_id' => 'required|exists:matchs,id',
            'players' => 'required|array',
            'players.starting' => 'required|array|min:11|max:11', // Ensure 11 starting players
            'players.substitute' => 'nullable|array|max:7', // Ensure no more than 7 substitutes
            'formation' => 'required|string',
        ]);
    
        try {
            // Get the logged-in user's team
            $team = auth()->user()->team;
            $match = Matchs::findOrFail($request->match_id);
    
            // Ensure the team is involved in the match
            if (!in_array($team->id, [$match->home_team_id, $match->away_team_id])) {
                return redirect()->back()->with('error', 'This match does not belong to your team.');
            }
    
            // Save the lineup to the database
            $lineup = new Lineup();
            $lineup->match_id = $request->match_id;
            $lineup->team_id = $team->id;
            $lineup->formation = $request->formation;
            $lineup->save();
    
            // Save starting players
            foreach ($request->players['starting'] as $playerId) {
                $lineup->players()->attach($playerId, ['position_type' => 'Starting']);
            }
    
            // Save substitute players (if any)
            if (!empty($request->players['substitute'])) {
                foreach ($request->players['substitute'] as $playerId) {
                    $lineup->players()->attach($playerId, ['position_type' => 'Substitute']);
                }
            }
    
            return redirect()->route('lineup.index')->with('success', 'Lineup saved successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while saving the lineup.');
        }
    }

    // Show lineup for a match
    public function show($match_id)
    {
        // Eager load match data with lineups
        $lineups = Lineup::with('match.homeTeam', 'match.awayTeam', 'players')->where('match_id', $match_id)->get();

        if ($lineups->isEmpty()) {
            return redirect()->back()->with('error', 'No lineup found for this match.');
        }

        return view('lineup.index', compact('lineups'));
    }
}
