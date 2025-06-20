<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model; // ✅ Ensure this is imported
use App\Models\Performance;

class Team extends Model
{
    use HasFactory, Notifiable;

    protected $guard = 'team'; // ✅ Set guard explicitly

    

    protected $table = 'teamss'; // Specify the correct table name

    protected $fillable = [
        'name',
        'logo',
        'primary_color',
        'secondary_color',
        'location',
        'history',
        'stadium',
        'points',
        'manager',
    ];



    // Relationship with User (One-to-One)
    public function user()
    {
        return $this->hasOne(User::class);
    }

    // Other relationships...
    public function players()
    {
        return $this->hasMany(Player::class, 'team_id');
    }

    public function matches()
    {
        return $this->hasMany(Matchs::class, 'home_team_id')->orWhere('away_team_id', $this->id);
    }
    

    public function doctors()
    {
        return $this->hasMany(Doctor::class, 'team_id');
    }

// Team model
public function sponsors()
{
    return $this->hasMany(Sponsor::class);
}



    public function matchesAsHomeTeam()
    {
        return $this->hasMany(Matchs::class, 'home_team_id');
    }

    public function matchesAsAwayTeam()
    {
        return $this->hasMany(Matchs::class, 'away_team_id');
    }

    public function performance()
    {
        return $this->hasOne(Performance::class, 'team_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function goals()
    {
    return $this->hasMany(Goal::class);
    }


    public function staffMembers()
    {
        return $this->belongsToMany(Staff::class, 'staff_team_bridge', 'team_id', 'staff_id');
    }


    // In Team.php model
public function histories()
{
    return $this->hasMany(History::class);  // Assuming History is the model for the related history table
}

public function injuries()
{
    return $this->hasMany(Injury::class, 'team_id');
}


public function receivingTeam()
{
    return $this->belongsTo(Team::class, 'receiving_team_id');
}





    
}
