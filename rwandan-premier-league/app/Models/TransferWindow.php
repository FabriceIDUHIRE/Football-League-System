<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferWindow extends Model
{
    use HasFactory;

    protected $fillable = ['is_open', 'start_date', 'end_date'];


        // Define relationship with the Player model
        public function player()
        {
            return $this->belongsTo(Player::class); // Assuming you have a Player model
        }
    
        // Define relationship with the Home Team model (from_team)
        public function homeTeam()
        {
            return $this->belongsTo(Team::class, 'from_team_id');
        }
    
        // Define relationship with the Away Team model (to_team)
        public function awayTeam()
        {
            return $this->belongsTo(Team::class, 'to_team_id');
        }


        public function transfers()
        {
            return $this->hasMany(PlayerTransfer::class);
        }


        
}

