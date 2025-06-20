<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lineup extends Model
{
    use HasFactory;

    protected $fillable = ['match_id', 'formation']; 

    public function players()
    {
        return $this->belongsToMany(Player::class, 'lineup_players')
                    ->withPivot('position_type')
                    ->withTimestamps();
    }

    public function getPlayerIdsAttribute()
    {
        return $this->players->pluck('id')->implode(','); // Get player IDs as a comma-separated string
    }


    public function match()
{
    return $this->belongsTo(Matchs::class, 'match_id');  // Adjust this if your column name is different
}

}
