<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'phone', 'team_id',
    ];

    // Relationships can be defined here
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
