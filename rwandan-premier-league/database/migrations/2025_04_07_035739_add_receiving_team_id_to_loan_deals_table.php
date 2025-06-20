<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReceivingTeamIdToLoanDealsTable extends Migration
{
    public function up()
    {
        Schema::table('loan_deals', function (Blueprint $table) {
            $table->unsignedBigInteger('receiving_team_id')->nullable()->after('team_id');
            // Do NOT add foreign key here
        });
        
    }

    public function down()
    {
        Schema::table('loan_deals', function (Blueprint $table) {
            $table->dropForeign(['receiving_team_id']);
            $table->dropColumn('receiving_team_id');
        });
    }
}
