<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('matchs', function (Blueprint $table) {
            $table->bigInteger('assistant_referee1_id')->unsigned()->nullable()->after('referee_id');
            $table->bigInteger('assistant_referee2_id')->unsigned()->nullable()->after('assistant_referee1_id');
            $table->bigInteger('fourth_referee_id')->unsigned()->nullable()->after('assistant_referee2_id');
            $table->bigInteger('match_commissioner_id')->unsigned()->nullable()->after('fourth_referee_id');

            // Foreign key constraints
            $table->foreign('assistant_referee1_id')->references('id')->on('referees')->onDelete('set null');
            $table->foreign('assistant_referee2_id')->references('id')->on('referees')->onDelete('set null');
            $table->foreign('fourth_referee_id')->references('id')->on('referees')->onDelete('set null');
            $table->foreign('match_commissioner_id')->references('id')->on('match_commissioners')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('matchs', function (Blueprint $table) {
            $table->dropForeign(['assistant_referee1_id']);
            $table->dropForeign(['assistant_referee2_id']);
            $table->dropForeign(['fourth_referee_id']);
            $table->dropForeign(['match_commissioner_id']);

            $table->dropColumn(['assistant_referee1_id', 'assistant_referee2_id', 'fourth_referee_id', 'match_commissioner_id']);
        });
    }
};

