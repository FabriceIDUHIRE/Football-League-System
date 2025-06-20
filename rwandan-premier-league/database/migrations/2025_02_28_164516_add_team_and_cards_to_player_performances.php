<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('player_performances', function (Blueprint $table) {
            $table->foreignId('team_id')->constrained('teamss')->onDelete('cascade')->after('player_id');
            $table->integer('yellow_cards')->default(0)->after('clean_sheets');
            $table->integer('red_cards')->default(0)->after('yellow_cards');
        });
    }

    public function down() {
        Schema::table('player_performances', function (Blueprint $table) {
            $table->dropForeign(['team_id']);
            $table->dropColumn(['team_id', 'yellow_cards', 'red_cards']);
        });
    }
};

