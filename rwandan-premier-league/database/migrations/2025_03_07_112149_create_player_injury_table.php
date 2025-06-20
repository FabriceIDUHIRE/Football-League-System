<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerInjuryTable extends Migration
{
    public function up()
    {
        Schema::create('player_injury', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('players')->onDelete('cascade');
            $table->foreignId('injury_id')->constrained('injuries')->onDelete('cascade');
            $table->date('date_reported');
            $table->date('recovery_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('player_injury');
    }
}
