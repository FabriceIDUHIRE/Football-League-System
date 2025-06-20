<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $fillable = [
        'team_id', 
        'wins', 
        'losses', 
        'draws', 
        'goals_scored', 
        'goals_conceded', 
        'yellow_cards',   // Add yellow_cards
        'red_cards'       // Add red_cards
    ];

    // Assuming it belongs to a team
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
