<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchCommissioner extends Model
{
    //

    protected $fillable = ['name', 'email', 'phone', 'address'];

    public function matches()
    {
        return $this->hasMany(Matchs::class, 'match_commissioner_id');
    }
}
