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
    if (!Schema::hasTable('tickets')) {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('event');
            $table->decimal('price', 8, 2);
            $table->integer('seats');
            $table->timestamps();
        });
    }
}

    
    

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('tickets', function (Blueprint $table) {
        $table->dropColumn(['event', 'price', 'seats']);
    });
}
};
