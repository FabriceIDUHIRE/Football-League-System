<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['team_id', 'name', 'specialization', 'contact_info'];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    
}
