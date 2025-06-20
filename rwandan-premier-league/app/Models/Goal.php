<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;

   
    protected $table = 'goals'; 


    protected $fillable = [
        'match_id',
        'player_id',
        'minute',
        'team_id',
        'team_type',
        'goal_scored',
        'card',
        'injury',
    ];
    

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
    

    public function team()
    {
        return $this->belongsTo(Team::class);
    }


    // In the Goal model
public function match()
{
    return $this->belongsTo(Matchs::class);
}


}
