<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $isSqlite = DB::getDriverName() === 'sqlite';

        $datediff = $isSqlite
            ? "CAST(julianday(last_datetime) - julianday('1995-01-01') AS INTEGER)"
            : "DATEDIFF(last_datetime, '1995-01-01')";

        DB::statement("
            CREATE VIEW player_scores_view AS
            SELECT
                players.id AS player_id,
                RANK() OVER (ORDER BY (
                    $datediff +
                    area * 1000 -
                    degration * 1000 -
                    rate_sell * 100 -
                    rate_buy * 100
                ) DESC) AS position,
                nickname,
                last_datetime,
                finished,
                (
                    $datediff +
                    area * 1000 -
                    degration * 1000 -
                    rate_sell * 100 -
                    rate_buy * 100
                ) AS score
            FROM players;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS player_scores_view");
    }
};
