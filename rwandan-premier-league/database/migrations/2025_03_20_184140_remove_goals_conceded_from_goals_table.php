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
        Schema::table('goals', function (Blueprint $table) {
            $table->dropColumn('goals_conceded');
        });
    }
    
    public function down()
    {
        Schema::table('goals', function (Blueprint $table) {
            $table->integer('goals_conceded')->nullable(); // Restore the column in case of rollback
        });
    }
    
};
