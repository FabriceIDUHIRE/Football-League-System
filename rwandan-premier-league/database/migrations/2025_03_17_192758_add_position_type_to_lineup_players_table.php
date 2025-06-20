<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPositionTypeToLineupPlayersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Check if the column already exists before attempting to add it
        if (!Schema::hasColumn('lineup_players', 'position_type')) {
            Schema::table('lineup_players', function (Blueprint $table) {
                $table->enum('position_type', ['Starting', 'Substitute'])->default('Starting');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lineup_players', function (Blueprint $table) {
            $table->dropColumn('position_type');
        });
    }
}


