<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddYellowCardsAndRedCardsToPerformances extends Migration
{
    public function up()
    {
        Schema::table('performances', function (Blueprint $table) {
            $table->integer('yellow_cards')->default(0); // Adding yellow_cards column
            $table->integer('red_cards')->default(0);    // Adding red_cards column
        });
    }

    public function down()
    {
        Schema::table('performances', function (Blueprint $table) {
            $table->dropColumn(['yellow_cards', 'red_cards']); // Dropping these columns in case of rollback
        });
    }
}

