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
        Schema::table('punishments', function (Blueprint $table) {
            // Check if the user_id column exists and if the foreign key exists before dropping them
            if (Schema::hasColumn('punishments', 'user_id')) {
                $table->dropForeign(['user_id']); // Drop the foreign key if it exists
                $table->dropColumn('user_id');    // Drop the column if it exists
            }

            // Check if the team_id column exists before adding it
            if (!Schema::hasColumn('punishments', 'team_id')) {
                $table->foreignId('team_id')->nullable()->constrained('teamss')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('punishments', function (Blueprint $table) {
            // Add back the user_id column and foreign key
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            
            // Remove the team_id column
            $table->dropColumn('team_id');
        });
    }
};
