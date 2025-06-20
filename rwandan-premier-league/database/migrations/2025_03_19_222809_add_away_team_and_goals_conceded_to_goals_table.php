<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->unsignedBigInteger('away_team_id')->after('team_id');
            $table->integer('goals_conceded')->default(0)->after('goal_scored');
        });
    }

    public function down()
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->dropColumn(['away_team_id', 'goals_conceded']);
        });
    }
};

