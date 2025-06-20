<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoricalTeamsTable extends Migration
{
    public function up()
    {
        Schema::create('historical_teams', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('team_id');
            $table->string('historical_season');
            $table->text('reason')->nullable();
            $table->date('historical_date');
            $table->integer('final_position');
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teamss')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historical_teams');
    }
}

