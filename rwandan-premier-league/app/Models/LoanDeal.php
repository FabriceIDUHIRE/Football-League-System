<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanDeal extends Model
{
    use HasFactory;

    // Add 'player_id' to the fillable property
    protected $fillable = [
        'player_id',        // Add player_id to the fillable array
        'team_id',
        'receiving_team_id',
        'loan_start_date',
        'loan_end_date',
        'has_buy_clause',
        'buy_clause_fee',
    ];


    // In LoanDeal model
public function player()
{
    return $this->belongsTo(Player::class, 'player_id');
}


public function receivingTeam()
{
    return $this->belongsTo(Team::class, 'receiving_team_id');
}


}
