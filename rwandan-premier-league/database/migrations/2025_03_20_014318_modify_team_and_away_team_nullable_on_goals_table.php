<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('goals', function (Blueprint $table) {
            // Make both team_id and away_team_id nullable
            $table->unsignedBigInteger('team_id')->nullable()->change();
            $table->unsignedBigInteger('away_team_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('goals', function (Blueprint $table) {
            // Revert back team_id and away_team_id to non-nullable
            $table->unsignedBigInteger('team_id')->nullable(false)->change();
            $table->unsignedBigInteger('away_team_id')->nullable(false)->change();
        });
    }
    
};
