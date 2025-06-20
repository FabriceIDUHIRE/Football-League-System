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
        Schema::table('match_results', function (Blueprint $table) {
            // Add column if it doesn't already exist
            if (!Schema::hasColumn('match_results', 'referee_id')) {
                $table->unsignedBigInteger('referee_id')->nullable();
            }
    
            if (!Schema::hasColumn('match_results', 'fourth_referee_id')) {
                $table->unsignedBigInteger('fourth_referee_id')->nullable();
            }
    
            if (!Schema::hasColumn('match_results', 'referee_assessor_id')) {
                $table->unsignedBigInteger('referee_assessor_id')->nullable();
            }
    
            if (!Schema::hasColumn('match_results', 'assistant_referee_1_id')) {
                $table->unsignedBigInteger('assistant_referee_1_id')->nullable();
            }
    
            if (!Schema::hasColumn('match_results', 'assistant_referee_2_id')) {
                $table->unsignedBigInteger('assistant_referee_2_id')->nullable();
            }
        });
    }
    
    public function down()
    {
        Schema::table('match_results', function (Blueprint $table) {
            $table->dropColumn('referee_id');
            $table->dropColumn('fourth_referee_id');
            $table->dropColumn('referee_assessor_id');
            $table->dropColumn('assistant_referee_1_id');
            $table->dropColumn('assistant_referee_2_id');
        });
    }
    
};
