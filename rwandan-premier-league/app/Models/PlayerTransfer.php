<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerTransfer extends Model
{
    use HasFactory;

    protected $table = 'transfers';

    protected $fillable = [
        'player_id',
        'from_team_id',
        'to_team_id',
        'transfer_fee',
        'transfer_date',
        'contract_duration',
        'status',
    ];

    // Cast 'transfer_date' to Carbon
    protected $casts = [
        'transfer_date' => 'datetime',
    ];

    // Relationships
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function fromTeam()
    {
        return $this->belongsTo(Team::class, 'from_team_id');
    }

    public function toTeam()
    {
        return $this->belongsTo(Team::class, 'to_team_id');
    }

    public function transferWindow()
    {
        return $this->belongsTo(TransferWindow::class);
    }
}

