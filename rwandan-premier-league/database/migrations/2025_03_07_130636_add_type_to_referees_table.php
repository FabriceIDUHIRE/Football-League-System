<?php

// database/migrations/xxxx_xx_xx_xxxxxx_add_type_to_referees_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeToRefereesTable extends Migration
{
    public function up()
    {
        Schema::table('referees', function (Blueprint $table) {
            $table->string('type')->nullable();  // Add the 'type' column to store the referee type (e.g., central, assistant, or fourth)
        });
    }

    public function down()
    {
        Schema::table('referees', function (Blueprint $table) {
            $table->dropColumn('type');  // Remove the 'type' column if the migration is rolled back
        });
    }
}
