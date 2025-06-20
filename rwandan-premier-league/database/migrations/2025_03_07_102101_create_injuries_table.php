<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('injuries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('player_id');
            $table->string('injury_type');
            $table->enum('severity', ['minor', 'moderate', 'severe'])->default('minor');
            $table->date('injury_date');
            $table->date('expected_recovery_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('player_id')->references('id')->on('players')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('injuries');
    }
};
