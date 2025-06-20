<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Creating the match_summary_view
        DB::statement("
            CREATE VIEW match_summary_view AS  
            SELECT  
                match_id,  
                COUNT(CASE WHEN injury IS NOT NULL THEN 1 END) AS total_injuries,  
                COUNT(CASE WHEN card IS NOT NULL THEN 1 END) AS total_cards,  
                COUNT(CASE WHEN card = 'yellow' THEN 1 END) AS yellow_cards,  
                COUNT(CASE WHEN card = 'red' THEN 1 END) AS red_cards,  
                COUNT(CASE WHEN injury IS NULL AND card IS NULL THEN 1 END) AS total_goals  
            FROM goals  
            GROUP BY match_id;
        ");

        // Creating the player_performance_view
        DB::statement("
            CREATE VIEW player_performance_view AS  
            SELECT  
                match_id,  
                player_id,  
                COUNT(CASE WHEN injury IS NOT NULL THEN 1 END) AS injuries,  
                COUNT(CASE WHEN card IS NOT NULL THEN 1 END) AS cards,  
                COUNT(CASE WHEN card = 'yellow' THEN 1 END) AS yellow_cards,  
                COUNT(CASE WHEN card = 'red' THEN 1 END) AS red_cards,  
                COUNT(CASE WHEN injury IS NULL AND card IS NULL THEN 1 END) AS goals  
            FROM goals  
            GROUP BY match_id, player_id;
        ");
    }

    public function down(): void
    {
        // Drop the views if rolling back
        DB::statement("DROP VIEW IF EXISTS match_summary_view");
        DB::statement("DROP VIEW IF EXISTS player_performance_view");
    }
};

