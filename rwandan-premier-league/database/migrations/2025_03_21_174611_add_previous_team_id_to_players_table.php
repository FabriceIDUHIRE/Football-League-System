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
        Schema::table('players', function (Blueprint $table) {
            $table->unsignedBigInteger('previous_team_id')->nullable()->after('team_id');
            $table->foreign('previous_team_id')->references('id')->on('teamss')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('players', function (Blueprint $table) {
            $table->dropForeign(['previous_team_id']);
            $table->dropColumn('previous_team_id');
        });
    }
    
};
