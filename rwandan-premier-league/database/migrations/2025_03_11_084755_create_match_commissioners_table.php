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
        Schema::create('match_commissioners', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name'); // Name of the commissioner
            $table->string('email')->unique(); // Unique email
            $table->string('phone')->nullable(); // Phone number (nullable in case not provided)
            $table->string('address')->nullable(); // Address (nullable)
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('match_commissioners');
    }
    
};
