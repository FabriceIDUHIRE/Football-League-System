<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePunishmentPlayerTable extends Migration
{
    public function up()
    {
        Schema::create('punishment_player', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('players')->onDelete('cascade');
            $table->foreignId('punishment_id')->constrained('punishments')->onDelete('cascade');
            $table->date('date_imposed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('punishment_player');
    }
}
