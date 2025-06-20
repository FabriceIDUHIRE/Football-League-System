<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    // Specify the table name if it's different from the default (Laravel assumes plural form)
    protected $table = 'players';

    // Specify the fillable fields based on the columns in your 'players' table
    protected $fillable = [
        'name', 'position', 'team_id', 'dob', 'nationality', 
        'contract_start_date', 'contract_end_date', 'jersey_number', 'image'
    ];
    
    

    // Define relationships or other logic here (if applicable)

    public function performance()
    {
        return $this->hasOne(PlayerPerformance::class); // Adjust if the relationship type is different
    }


  
public function team()
{
    return $this->belongsTo(Team::class);
}





public function lineups()
{
    return $this->belongsToMany(Lineup::class, 'lineup_players') 
                ->withPivot('position_type')
                ->withTimestamps();
}


// Player Model
public function contract()
{
    return $this->hasOne(Contract::class);  // assuming a player has only one active contract
}


public function previous_team()
    {
        return $this->belongsTo(Team::class, 'previous_team_id');
    }


    public function injuries()
    {
        return $this->hasMany(Injury::class);
    }


    public function goals()
{
    return $this->hasMany(Goal::class);
}


    

    //Search

    public function getUrlAttribute()
{
    return route('players.show', ['player' => $this->id]);
}

}

