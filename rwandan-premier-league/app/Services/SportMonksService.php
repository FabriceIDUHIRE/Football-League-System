<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SportMonksService
{
    public function getSeasons($leagueId)
    {
        $response = Http::get("https://api.sportmonks.com/football/seasons", [
            'league_id' => $leagueId,
            'api_token' => env('SPORTMONKS_API_TOKEN'),
        ]);

        return $response->json();
    }

    public function getStandings($leagueId, $seasonId)
    {
        $response = Http::get("https://api.sportmonks.com/football/standings", [
            'league_id' => $leagueId,
            'season_id' => $seasonId,
            'api_token' => env('SPORTMONKS_API_TOKEN'),
        ]);

        return $response->json(); // Ensure this is structured correctly
    }
}
