<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Player;
use App\Models\Match;
use App\Models\Stadium;
use App\Models\Sponsor;
use App\Models\Referee;
use App\Models\Fixture;
use App\Models\Ticket;
use App\Models\Announcement;
use App\Models\Financial;
use App\Models\MatchCategory;

class SearchController extends Controller
{



    
    public function search(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([]);
        }

        $teams = Team::where('name', 'LIKE', '%' . $query . '%')
            ->get(['id', 'name as title', 'description', 'url']);
        $players = Player::where('name', 'LIKE', '%' . $query . '%')
            ->get(['id', 'name as title', 'position as description', 'url']);
        $matches = Matchs::where('match_name', 'LIKE', '%' . $query . '%')
            ->get(['id', 'match_name as title', 'description', 'url']);
        $stadiums = Stadium::where('name', 'LIKE', '%' . $query . '%')
            ->get(['id', 'name as title', 'location as description', 'url']);
        $sponsors = Sponsor::where('sponsor_name', 'LIKE', '%' . $query . '%')
            ->get(['id', 'sponsor_name as title', 'amount as description', 'url']);
        $referees = Referee::where('name', 'LIKE', '%' . $query . '%')
            ->get(['id', 'name as title', 'experience as description', 'url']);
        $fixtures = Fixture::where('title', 'LIKE', '%' . $query . '%')
            ->get(['id', 'title as title', 'date as description', 'url']);
        $tickets = Ticket::where('name', 'LIKE', '%' . $query . '%')
            ->get(['id', 'name as title', 'price as description', 'url']);
        $announcements = Announcement::where('title', 'LIKE', '%' . $query . '%')
            ->get(['id', 'title', 'content as description', 'url']);
        $financials = Financial::where('description', 'LIKE', '%' . $query . '%')
            ->get(['id', 'description as title', 'amount as description', 'url']);
        $matchCategories = MatchCategory::where('name', 'LIKE', '%' . $query . '%')
            ->get(['id', 'name as title', 'description', 'url']);

        $results = $teams
            ->merge($players)
            ->merge($matches)
            ->merge($stadiums)
            ->merge($sponsors)
            ->merge($referees)
            ->merge($fixtures)
            ->merge($tickets)
            ->merge($announcements)
            ->merge($financials)
            ->merge($matchCategories);

        return response()->json($results);
    }
}

