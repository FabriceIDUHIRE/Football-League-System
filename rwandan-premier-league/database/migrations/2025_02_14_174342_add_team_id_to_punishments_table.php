<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTeamIdToPunishmentsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('punishments', function (Blueprint $table) {
            if (!Schema::hasColumn('punishments', 'team_id')) {
                $table->foreignId('team_id')->nullable()->constrained('teamss')->onDelete('set null');
            }
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('punishments', function (Blueprint $table) {
            // Remove the team_id column
            $table->dropForeign(['team_id']);
            $table->dropColumn('team_id');
        });
    }
}
