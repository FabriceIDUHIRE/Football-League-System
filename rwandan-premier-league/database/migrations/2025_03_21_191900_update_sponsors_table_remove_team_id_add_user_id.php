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
        Schema::table('sponsors', function (Blueprint $table) {
            // Remove the 'team_id' column
            $table->dropColumn('team_id');
    
            // Add the 'user_id' column
            $table->unsignedBigInteger('user_id'); // This will reference the user's ID (admin or team user)
    
            // Optional: If you want to create a foreign key relationship with the users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            // Add the 'team_id' column back (if rolling back migration)
            $table->unsignedBigInteger('team_id')->nullable();
    
            // Remove the 'user_id' column
            $table->dropColumn('user_id');
        });
    }
    
};
