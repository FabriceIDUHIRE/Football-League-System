<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matchs extends Model
{


    protected $table = 'matchs'; 


    
    protected $fillable = [
        'match_date', 
        'stadium_id', 
        'referee_id', 
        'assistant_referee1_id', 
        'assistant_referee2_id', 
        'fourth_referee_id', 
        'match_commissioner_id', 
        'home_team_id', 
        'away_team_id', 
        'match_category_id'
    ];
    

    protected $casts = [
        'match_date' => 'datetime',
    ];
    

    // Define relationship to Referee
    public function referee()
    {
        return $this->belongsTo(Referee::class);
    }

    public function assistantReferee1()
    {
        return $this->belongsTo(Referee::class, 'assistant_referee1_id');
    }

    public function assistantReferee2()
    {
        return $this->belongsTo(Referee::class, 'assistant_referee2_id');
    }

    public function fourthReferee()
    {
        return $this->belongsTo(Referee::class, 'fourth_referee_id');
    }

    public function matchCommissioner()
    {
        return $this->belongsTo(MatchCommissioner::class, 'match_commissioner_id');
    }

    // Define relationship to MatchCategory
    public function category()
    {
        return $this->belongsTo(MatchCategory::class, 'match_category_id');
    }

    // Define relationship to Home Team
    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function matchCategory()
    {
        return $this->belongsTo(MatchCategory::class);
    }

    // Define relationship to Stadium
    public function stadium()
    {
        return $this->belongsTo(Stadium::class, 'stadium_id');
    }

    // In Match Model
    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }


    public function lineups()
    {
        return $this->hasMany(Lineup::class);
    }


    // In App\Models\Matchs.php

public function opponent_team()
{
    // If the match is at home for the team, the opponent will be the away team
    return $this->belongsTo(Team::class, 'away_team_id');
}


}

