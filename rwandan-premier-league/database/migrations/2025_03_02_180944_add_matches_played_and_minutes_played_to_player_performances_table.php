<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('player_performances', function (Blueprint $table) {
            $table->integer('matches_played')->default(0)->after('clean_sheets');
            $table->integer('minutes_played')->default(0)->after('matches_played');
        });
    }

    public function down()
    {
        Schema::table('player_performances', function (Blueprint $table) {
            $table->dropColumn(['matches_played', 'minutes_played']);
        });
    }
};

