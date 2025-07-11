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
            $table->renameColumn('description', 'reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('punishments', function (Blueprint $table) {
            $table->renameColumn('reason', 'description');
        });
    }
};
