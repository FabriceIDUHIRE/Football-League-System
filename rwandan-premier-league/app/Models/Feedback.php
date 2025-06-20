<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'message', 'team_id'
    ];

    // You can also define relationships if needed, like:
     public function team()
     {
         return $this->belongsTo(Team::class);
     }
}
