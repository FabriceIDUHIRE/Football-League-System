<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerPerformance extends Model
{
    use HasFactory;

    // Add all the relevant fields to the $fillable array
    protected $fillable = [
        'player_id', 
        'goals', 
        'assists', 
        'clean_sheets', 
        'yellow_cards', 
        'red_cards', 
        'matches_played', 
        'minutes_played'
    ];

    // Define the relationship with Player
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }


public function team()
{
    return $this->belongsTo(Team::class);
}

}
