<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    use HasFactory;

    protected $table = 'sponsorships';

    protected $fillable = [
        'team_id', 
        'sponsor_name', 
        'contract_start_date', 
        'contract_end_date', 
        'amount', 
    ];

    // Relationships
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
