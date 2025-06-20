<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerTransferTable extends Migration
{
    public function up()
    {
        Schema::create('player_transfer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained('players')->onDelete('cascade');
            $table->foreignId('from_team_id')->constrained('teamss')->onDelete('cascade');
            $table->foreignId('to_team_id')->constrained('teamss')->onDelete('cascade');
            $table->date('transfer_date');
            $table->decimal('transfer_fee', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('player_transfer');
    }
}
