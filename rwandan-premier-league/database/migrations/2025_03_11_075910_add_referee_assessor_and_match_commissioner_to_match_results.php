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
        Schema::table('match_results', function (Blueprint $table) {
            $table->unsignedBigInteger('referee_assessor_id')->nullable()->after('fourth_referee_id');
            $table->unsignedBigInteger('match_commissioner_id')->nullable()->after('referee_assessor_id');
    
            $table->foreign('referee_assessor_id')->references('id')->on('referees')->onDelete('set null');
            $table->foreign('match_commissioner_id')->references('id')->on('users')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('match_results', function (Blueprint $table) {
            $table->dropForeign(['referee_assessor_id']);
            $table->dropForeign(['match_commissioner_id']);
            $table->dropColumn(['referee_assessor_id', 'match_commissioner_id']);
        });
    }
    
};
