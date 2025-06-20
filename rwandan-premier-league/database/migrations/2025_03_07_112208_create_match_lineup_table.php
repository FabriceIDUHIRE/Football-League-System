<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchLineupTable extends Migration
{
    public function up()
    {
        Schema::create('match_lineup', function (Blueprint $table) {
            $table->id();
            $table->foreignId('match_id')->constrained('matchs')->onDelete('cascade');
            $table->foreignId('player_id')->constrained('players')->onDelete('cascade');
            $table->enum('position', ['Goalkeeper', 'Defender', 'Midfielder', 'Forward']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('match_lineup');
    }
}
