<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFanEngagementTable extends Migration
{
    public function up()
    {
        Schema::create('fan_engagement', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained('teamss')->onDelete('cascade');
            $table->text('activity_description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fan_engagement');
    }
}

