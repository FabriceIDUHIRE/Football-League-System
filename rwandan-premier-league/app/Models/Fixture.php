<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fixture extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'match_date',
        'stadium_id',
        'referee_id',
        'match_category_id',
    ];

    // Define the homeTeam relationship
    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    // Define the awayTeam relationship
    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    // Define the matchCategory relationship
    public function matchCategory()
    {
        return $this->belongsTo(MatchCategory::class, 'match_category_id');
    }
}
