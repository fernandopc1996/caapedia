<?php

namespace App\Models\Game;

use Illuminate\Database\Eloquent\Model;

class PlayerScore extends Model
{
    protected $table = 'player_scores_view';

    public $timestamps = false;

    protected $fillable = [
        'player_id',
        'position',
        'nickname',
        'last_datetime',
        'finished',
        'score',
    ];
}