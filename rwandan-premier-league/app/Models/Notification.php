<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['team_id', 'message', 'type', 'is_read'];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}

