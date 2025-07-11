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
        Schema::table('sponsors', function (Blueprint $table) {
            $table->string('logo')->nullable(); // Adds a nullable 'logo' column
        });
    }
    
    public function down()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            $table->dropColumn('logo'); // Drops the 'logo' column if needed
        });
    }
    
};
