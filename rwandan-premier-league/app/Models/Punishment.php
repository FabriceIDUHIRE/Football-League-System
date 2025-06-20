<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Punishment extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'reason', 'team_id', 'player_id', 'coach_id', 'referee_id', 'start_date', 'end_date'
    ];

    // Relationship to Team
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
    
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }
    
    public function coach()
    {
        return $this->belongsTo(Coach::class, 'coach_id');
    }
    
    public function referee()
    {
        return $this->belongsTo(Referee::class, 'referee_id');
    }
    
}
