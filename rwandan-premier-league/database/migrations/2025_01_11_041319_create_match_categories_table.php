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
        // Create the match_categories table
        Schema::create('match_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Column for category name (Super Cup, CAF, etc.)
            $table->text('description')->nullable(); // Add description column
            $table->timestamps();
        });

        // Add the category_id to the matchs table
        Schema::table('matchs', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('stadium_id'); // Add category_id
            $table->foreign('category_id')->references('id')->on('match_categories')->onDelete('set null'); // Foreign key constraint
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Drop the foreign key and the column from matchs
        Schema::table('matchs', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });

        // Drop the match_categories table
        Schema::dropIfExists('match_categories');
    }
};
