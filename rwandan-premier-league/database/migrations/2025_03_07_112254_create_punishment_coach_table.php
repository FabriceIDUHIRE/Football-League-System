<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePunishmentCoachTable extends Migration
{
    public function up()
    {
        Schema::create('punishment_coach', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coach_id')->constrained('coaches')->onDelete('cascade');
            $table->foreignId('punishment_id')->constrained('punishments')->onDelete('cascade');
            $table->date('date_imposed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('punishment_coach');
    }
}
