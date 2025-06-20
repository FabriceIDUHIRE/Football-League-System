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
    Schema::table('tickets', function (Blueprint $table) {
        if (!Schema::hasColumn('tickets', 'price')) {
            $table->decimal('price', 10, 2)->nullable(false);
        } else {
            $table->decimal('price', 10, 2)->change();
        }
    });
}


    
    public function down()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->decimal('price', 8, 2)->change(); // Revert to the previous precision if necessary
        });
    }
    
};
