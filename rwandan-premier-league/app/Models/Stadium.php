<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stadium extends Model
{
    use HasFactory;

    // If the table name is not pluralized by convention, you can specify it:
    protected $table = 'stadiums'; 


    // Specify the fields that are mass-assignable
    protected $fillable = [
        'name',
        'location',
        'capacity',
    ];
}


