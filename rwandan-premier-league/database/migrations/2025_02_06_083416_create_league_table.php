<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeagueTable extends Migration
{
    public function up()
    {
        Schema::create('league_table', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teamss')->onDelete('cascade');
            $table->integer('points');
            $table->integer('matches_played');
            $table->integer('wins');
            $table->integer('losses');
            $table->integer('draws');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('league_table');
    }
}

