<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Injury extends Model
{
    use HasFactory;

    protected $table = 'injuries';

    protected $fillable = [
        'player_id', 'doctor_id', 'injury_type', 'severity', 'injury_date',
        'expected_recovery_date', 'notes', 'team_id'
    ];

    protected $casts = [
        'injury_date' => 'date',
        'expected_recovery_date' => 'date',
    ];

    // Relationships


    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    
    public function playerInjuries()
    {
        return $this->hasMany(PlayerInjury::class);
    }

    public function player()
{
    return $this->belongsTo(Player::class, 'player_id');
}


public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

}

