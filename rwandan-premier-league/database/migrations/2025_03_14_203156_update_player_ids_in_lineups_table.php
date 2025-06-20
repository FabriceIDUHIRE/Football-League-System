<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('lineups', function (Blueprint $table) {
            $table->text('player_ids')->default('')->change();
        });
    }

    public function down()
    {
        Schema::table('lineups', function (Blueprint $table) {
            $table->text('player_ids')->nullable()->change();
        });
    }
};

