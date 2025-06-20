<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    // Specify the database table (optional but good practice)
    protected $table = 'coaches';

    // Allow mass assignment for these fields
    protected $fillable = ['name', 'team_id'];

    // Define the relationship with the Team model
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
