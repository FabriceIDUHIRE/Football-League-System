<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Performance;
use App\Models\Team;

class PerformanceSeeder extends Seeder
{
    public function run()
    {
        $teams = Team::all();

        foreach ($teams as $team) {
            Performance::updateOrCreate(
                ['team_id' => $team->id],
                ['wins' => 0, 'losses' => 0, 'draws' => 0, 'goals_scored' => 0, 'goals_conceded' => 0]
            );
        }
    }
}

