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
            // Add user_id column as unsigned big integer
            $table->unsignedBigInteger('user_id')->nullable();
    
            // Add foreign key constraint referencing the users table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            // Drop foreign key and column on rollback
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
    
};
