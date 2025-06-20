<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeamAndDoctorToInjuriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('injuries', function (Blueprint $table) {
            // Add team_id and doctor_id columns
            $table->unsignedBigInteger('team_id')->nullable()->after('player_id');
            $table->unsignedBigInteger('doctor_id')->nullable()->after('injury_date');

            // Add foreign key constraints
            $table->foreign('team_id')->references('id')->on('teamss')->onDelete('set null');
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('injuries', function (Blueprint $table) {
            // Drop the foreign key constraints and columns
            $table->dropForeign(['team_id']);
            $table->dropForeign(['doctor_id']);
            $table->dropColumn(['team_id', 'doctor_id']);
        });
    }
}
