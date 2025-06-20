<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'team_id',
        'title',
        'content',
        'image',
        'category',
        'status'
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}

