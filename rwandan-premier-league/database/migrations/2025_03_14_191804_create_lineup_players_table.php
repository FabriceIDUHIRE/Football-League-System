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
        Schema::create('lineup_players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lineup_id');
            $table->unsignedBigInteger('player_id');
            $table->string('position_type'); // 'Starting' or 'Substitute'
            $table->timestamps();
    
            $table->foreign('lineup_id')->references('id')->on('lineups')->onDelete('cascade');
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lineup_players');
    }
};
