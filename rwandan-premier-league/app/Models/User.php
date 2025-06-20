<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon; // <-- Make sure to import Carbon

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;


    // Add this method to define the username field
    public function getAuthIdentifierName()
    {
        return 'username';  // Ensures the username is used for login instead of email
    }

    protected $fillable = ['username', 'email', 'password', 'status', 'blocked_at'];

    public function isBlocked()
    {
        if ($this->status === 'blocked' && $this->blocked_at) {
            return Carbon::parse($this->blocked_at)->addHours(24)->isFuture();
        }
        return false;
    }

    // Define role check methods if needed
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isTeamManager()
    {
        return $this->role === 'team_manager';
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Many-to-many relationship with roles
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }



public function team()
{
    return $this->belongsTo(Team::class);
}


    public function matchCommissioner()
    {
        return $this->hasOne(MatchCommissioner::class);
    }

    // In User model
    public function punishments()
    {
        return $this->hasMany(Punishment::class);
    }
}
