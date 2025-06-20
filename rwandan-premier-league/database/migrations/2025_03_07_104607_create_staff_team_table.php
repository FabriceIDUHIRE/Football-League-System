<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('staff_team', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_id')->constrained('staff')->onDelete('cascade');
            $table->foreignId('team_id')->constrained('teamss')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date')->nullable(); // NULL if still with the team
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff_team');
    }
};

