<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('teamss', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('primary_color');
            $table->string('secondary_color');
            $table->string('location');
            $table->text('history')->nullable();
            $table->string('stadium')->nullable();
            $table->integer('points')->default(0); // Added points for ranking
            $table->string('manager')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade'); // If linking to users
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('teamss');
    }
};

