<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Ticket extends Model
{
    //

    use HasFactory;

    protected $fillable = ['event', 'price', 'seats', 'status'];

    public function index()
    {
        $tickets = Ticket::with(['homeTeam', 'awayTeam'])->get();
        return view('tickets.index', compact('tickets'));
    }
    

    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('event');
            $table->decimal('price', 10, 2);
            $table->integer('seats');
            $table->string('status');
        
            // Foreign keys to 'teamss' table
            $table->unsignedBigInteger('home_team_id');
            $table->unsignedBigInteger('away_team_id');
        
            // Define foreign key constraints
            $table->foreign('home_team_id')->references('id')->on('teamss')->onDelete('cascade');
            $table->foreign('away_team_id')->references('id')->on('teamss')->onDelete('cascade');
        
            $table->timestamps();
        });
    }
    

// In the Ticket model
public function homeTeam()
{
    return $this->belongsTo(Team::class, 'home_team_id');
}

public function awayTeam()
{
    return $this->belongsTo(Team::class, 'away_team_id');
}


}
