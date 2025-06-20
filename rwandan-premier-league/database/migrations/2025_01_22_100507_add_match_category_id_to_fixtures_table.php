<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMatchCategoryIdToFixturesTable extends Migration
{
    public function up()
{
    if (!Schema::hasColumn('fixtures', 'match_category_id')) {
        Schema::table('fixtures', function (Blueprint $table) {
            $table->unsignedBigInteger('match_category_id')->nullable(false);
        });
    }
}


public function down()
{
    Schema::table('fixtures', function (Blueprint $table) {
        if (Schema::hasColumn('fixtures', 'match_category_id')) {
            // Remove only if it exists
            $table->dropForeign(['match_category_id']);
            $table->dropColumn('match_category_id');
        }
    });
}

}
