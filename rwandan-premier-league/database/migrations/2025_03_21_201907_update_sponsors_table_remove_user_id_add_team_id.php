<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSponsorsTableRemoveUserIdAddTeamId extends Migration
{
    public function up()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            // Drop the foreign key constraint for user_id
            $table->dropForeign(['user_id']);  // Specify the correct foreign key constraint name

            // Drop the user_id column
            $table->dropColumn('user_id');

            // Add the team_id column
            $table->unsignedBigInteger('team_id')->nullable()->after('sponsor_name');  // Adjust the position if necessary
            
            // Set the foreign key constraint for team_id (it should reference the teamss table)
            $table->foreign('team_id')->references('id')->on('teamss')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            // Revert the changes
            $table->dropForeign(['team_id']);
            $table->dropColumn('team_id');
            $table->unsignedBigInteger('user_id')->nullable()->after('sponsor_name');  // Adjust the position if necessary
        });
    }
}


