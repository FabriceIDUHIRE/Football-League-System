<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('manager_team', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manager_id')->constrained('managers')->onDelete('cascade');
            $table->foreignId('team_id')->constrained('teamss')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date')->nullable(); // NULL if still managing the team
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('manager_team');
    }
};

