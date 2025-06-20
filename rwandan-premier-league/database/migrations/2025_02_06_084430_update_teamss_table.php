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
        Schema::table('teamss', function (Blueprint $table) {
            // Drop the 'username' and 'password' columns if they exist
            $table->dropColumn(['username', 'password']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('teamss', function (Blueprint $table) {
            // Add back the 'username' and 'password' columns if you want to reverse this
            $table->string('username')->unique();
            $table->string('password');
        });
    }
};
