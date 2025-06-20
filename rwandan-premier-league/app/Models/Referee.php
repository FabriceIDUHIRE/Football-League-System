<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    use HasFactory;

    protected $table = 'referees';

    protected $fillable = [
        'name', 
        'email',
        'nationality',
        'experience_years',
        'profile_photo',
        'qualification',
        'type',  // Add type here
    ];

    public $timestamps = true;
}
