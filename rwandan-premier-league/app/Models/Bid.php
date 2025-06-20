<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'selling_team_id',
        'buying_team_id',
        'bid_amount',
        'status',
        'expiry_date',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function sellingTeam()
    {
        return $this->belongsTo(Team::class, 'selling_team_id');
    }

    public function buyingTeam()
    {
        return $this->belongsTo(Team::class, 'buying_team_id');
    }
}

