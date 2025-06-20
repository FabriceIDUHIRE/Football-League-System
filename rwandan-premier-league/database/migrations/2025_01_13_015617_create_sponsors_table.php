<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSponsorsTable extends Migration
{
    public function up()
    {
        Schema::create('sponsors', function (Blueprint $table) {
            $table->id();
            $table->string('sponsor_name');
            $table->unsignedBigInteger('team_id');  // Foreign key reference to teams table
            $table->foreign('team_id')->references('id')->on('teamss'); // Foreign key referencing 'teamss' table
            $table->boolean('league_sponsor')->default(false);
            $table->date('contract_start_date');
            $table->date('contract_end_date');
            $table->decimal('amount', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sponsors');
    }
}
