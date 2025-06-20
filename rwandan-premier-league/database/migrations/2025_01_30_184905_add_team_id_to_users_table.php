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
    Schema::table('users', function (Blueprint $table) {
        $table->unsignedBigInteger('team_id')->nullable(); // Add team_id column
        $table->foreign('team_id')->references('id')->on('teamss')->onDelete('set null'); // Define the foreign key relationship
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropForeign(['team_id']);
        $table->dropColumn('team_id');
    });
}

};
