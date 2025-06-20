<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->unsignedBigInteger('team_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('salary', 10, 2);
            $table->enum('contract_status', ['active', 'expired', 'terminated'])->default('active');
            $table->timestamps();

            // Foreign Keys
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teamss')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('contracts');
    }
};

