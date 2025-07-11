<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'staff';

    // Specify the columns that are mass assignable
    protected $fillable = ['name', 'position', 'team_id'];
}
