<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Player;
use App\Models\Matchs;
use Illuminate\Http\Request;
use Carbon\Carbon;


class GoalController extends Controller
{
    

    public function index()
    {
        // Set timezone explicitly
        date_default_timezone_set('Africa/Kigali');
    
        $startOfDay = Carbon::today('Africa/Kigali')->startOfDay();  // 2025-04-11 00:00:00
        $endOfDay = Carbon::today('Africa/Kigali')->endOfDay();      // 2025-04-11 23:59:59
    

    
        $todayMatches = Matchs::with(['homeTeam:id,name', 'awayTeam:id,name'])
                              ->whereBetween('match_date', [$startOfDay, $endOfDay])
                              ->get();
    
        $goals = Goal::with(['player:id,name', 'match.homeTeam:id,name', 'match.awayTeam:id,name'])->get();
        $players = Player::all();
    
        return view('goals.index', [
            'goals' => $goals,
            'players' => $players,
            'matches' => $todayMatches,
        ]);
    }
    





    public function edit($id)
    {
        $goal = Goal::with(['player', 'match.homeTeam', 'match.awayTeam'])->findOrFail($id);
    
        $match = $goal->match;
    
        // Fetch players from both home and away teams
        $players = Player::whereIn('team_id', [$match->home_team_id, $match->away_team_id])->get();
    
        return view('goals.edit', compact('goal', 'players', 'match'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'player_id' => 'required|exists:players,id',
            'minute' => 'required|integer|min:1|max:120',
            'event_type' => 'required|in:goal,card,injury',
            'goal_scored' => 'nullable|integer|min:0',
            'card' => 'nullable|in:yellow,red',
            'injury' => 'nullable|string|max:255',
            'team_type' => 'required|in:home,away',
        ]);
    
        $goal = Goal::findOrFail($id);
    
        $goal->player_id = $request->player_id;
        $goal->minute = $request->minute;
        $goal->team_type = $request->team_type;
    
        $goal->goal_scored = null;
        $goal->card = null;
        $goal->injury = null;
    
        if ($request->event_type == 'goal') {
            $goal->goal_scored = $request->goal_scored;
        } elseif ($request->event_type == 'card') {
            $goal->card = $request->card;
        } elseif ($request->event_type == 'injury') {
            $goal->injury = $request->injury;
        }
    
        $goal->save();
    
        return redirect()->route('goals.index')->with('success', 'Goal event updated successfully.');
    }

    public function create()
    {
        $matches = Matchs::with(['homeTeam.players', 'awayTeam.players'])->get();
        return view('goals.create', compact('matches'));
    }

    public function getPlayers($teamId)
    {
        $players = Player::where('team_id', $teamId)->get(['id', 'name']);
        return response()->json(['players' => $players]);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'match_id' => 'required|exists:matchs,id',
            'event_type' => 'required|in:goal,card,injury',
            'player_id' => 'required|exists:players,id',
            'minute' => 'required|integer|min:1',
            'goal_scored' => 'nullable|integer|min:1',
            'card' => 'nullable|in:yellow,red',
            'injury' => 'nullable|string',
        ]);
    
        $match = Matchs::findOrFail($request->match_id);
    
        if ($request->team_type == 'home') {
            $teamType = 'home';
        } elseif ($request->team_type == 'away') {
            $teamType = 'away';
        } else {
            return redirect()->back()->with('error', 'Invalid team type selected.');
        }
    
        $eventData = [
            'match_id' => $request->match_id,
            'player_id' => $request->player_id,
            'minute' => $request->minute,
            'team_type' => $teamType,
        ];
    
        if ($request->event_type === 'goal') {
            $eventData['goal_scored'] = $request->goal_scored ?? 1;
            $eventData['card'] = null;
            $eventData['injury'] = null;
        } elseif ($request->event_type === 'card') {
            $eventData['card'] = $request->card;
            $eventData['goal_scored'] = 0;
            $eventData['injury'] = null;
        } elseif ($request->event_type === 'injury') {
            $eventData['injury'] = $request->injury;
            $eventData['goal_scored'] = 0;
            $eventData['card'] = null;
        }
    
        Goal::create($eventData);
    
        return redirect()->route('goals.index')->with('success', 'Event recorded successfully.');
    }

    public function destroy(Goal $goal)
    {
        $goal->delete();
        return redirect()->route('goals.index')->with('success', 'Event deleted successfully.');
    }
}
