<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->dropForeign(['team_id']); // Drop foreign key (if exists)
            $table->dropColumn('team_id');   // Remove the column
        });
    }

    public function down()
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }
};
