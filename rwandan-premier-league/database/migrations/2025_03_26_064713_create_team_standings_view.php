<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTeamStandingsView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE VIEW team_standings AS
            SELECT
                teamss.id AS team_id,
                teamss.name AS team_name,
                COUNT(CASE WHEN home_goals.team_type = 'home' AND home_goals.goal_scored > away_goals.goal_scored THEN 1 END) AS wins,
                COUNT(CASE WHEN away_goals.team_type = 'away' AND away_goals.goal_scored > home_goals.goal_scored THEN 1 END) AS away_wins,
                COUNT(CASE WHEN home_goals.team_type = 'home' AND home_goals.goal_scored = away_goals.goal_scored THEN 1 END) AS draws,
                COUNT(CASE WHEN away_goals.team_type = 'away' AND away_goals.goal_scored = home_goals.goal_scored THEN 1 END) AS away_draws,
                COUNT(CASE WHEN home_goals.team_type = 'home' AND home_goals.goal_scored < away_goals.goal_scored THEN 1 END) AS losses,
                COUNT(CASE WHEN away_goals.team_type = 'away' AND away_goals.goal_scored < home_goals.goal_scored THEN 1 END) AS away_losses,
                SUM(CASE WHEN home_goals.team_type = 'home' THEN home_goals.goal_scored ELSE 0 END) AS goals_for,
                SUM(CASE WHEN away_goals.team_type = 'away' THEN away_goals.goal_scored ELSE 0 END) AS away_goals_for,
                SUM(CASE WHEN home_goals.team_type = 'home' THEN away_goals.goal_scored ELSE 0 END) AS goals_against,
                SUM(CASE WHEN away_goals.team_type = 'away' THEN home_goals.goal_scored ELSE 0 END) AS away_goals_against,
                SUM(CASE WHEN home_goals.team_type = 'home' THEN home_goals.goal_scored ELSE 0 END) - 
                SUM(CASE WHEN home_goals.team_type = 'home' THEN away_goals.goal_scored ELSE 0 END) AS goal_difference,
                SUM(CASE WHEN home_goals.team_type = 'home' THEN home_goals.goal_scored ELSE 0 END) + 
                SUM(CASE WHEN away_goals.team_type = 'away' THEN away_goals.goal_scored ELSE 0 END) AS total_goals,
                (COUNT(CASE WHEN home_goals.team_type = 'home' AND home_goals.goal_scored > away_goals.goal_scored THEN 1 END) + 
                COUNT(CASE WHEN away_goals.team_type = 'away' AND away_goals.goal_scored > home_goals.goal_scored THEN 1 END)) * 3 + 
                (COUNT(CASE WHEN home_goals.team_type = 'home' AND home_goals.goal_scored = away_goals.goal_scored THEN 1 END) + 
                COUNT(CASE WHEN away_goals.team_type = 'away' AND away_goals.goal_scored = home_goals.goal_scored THEN 1 END)) AS points
            FROM
                teamss
            LEFT JOIN
                matchs AS m ON m.home_team_id = teamss.id OR m.away_team_id = teamss.id
            LEFT JOIN
                goals AS home_goals ON home_goals.match_id = m.id AND home_goals.team_type = 'home'
            LEFT JOIN
                goals AS away_goals ON away_goals.match_id = m.id AND away_goals.team_type = 'away'
            GROUP BY
                teamss.id, teamss.name;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS team_standings');
    }
}
