<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\MOdels\Sponsor;
use App\Models\Matchs;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class SelectController extends Controller
{

    
    public function index()
    {
        $teams = Team::all();
        return view('select_team', compact('teams'));
    }



    


    
    
    public function show($teamId)
    {
        $team = Team::findOrFail($teamId);
        $players = $team->players;
        $sponsors = Sponsor::where('team_id', $team->id)->get();

        // ✅ Only get the nearest upcoming match for this team
        $match = Matchs::with(['homeTeam', 'awayTeam', 'stadium'])
    ->where(function ($query) use ($team) {
        $query->where('home_team_id', $team->id)
              ->orWhere('away_team_id', $team->id);
    })
    ->where('match_date', '>', Carbon::now())
    ->orderBy('match_date', 'asc')
    ->first();


        return view('welcome', compact('team', 'sponsors', 'players', 'match'));
    }
    
    
    
    
    


    
}
