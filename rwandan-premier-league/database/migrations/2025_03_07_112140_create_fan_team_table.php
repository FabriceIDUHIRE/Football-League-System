<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFanTeamTable extends Migration
{
    public function up()
    {
        Schema::create('fan_team', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fan_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('team_id')->constrained('teamss')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fan_team');
    }
}
