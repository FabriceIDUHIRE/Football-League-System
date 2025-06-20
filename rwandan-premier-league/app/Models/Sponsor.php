<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    // Define the correct table name (do not declare it twice)
    protected $table = 'sponsors'; // Use this table name for the Sponsor model

    // Define the fillable fields for mass assignment
    protected $fillable = ['sponsor_name', 'team_id', 'contract_start_date', 'contract_end_date', 'amount', 'user_id', 'image_path'];


    // Define the relationship to Team (assuming each sponsor is associated with a team)
// Update the relationship to use the correct table name
public function team()
{
    return $this->belongsTo(Team::class);
}


}

