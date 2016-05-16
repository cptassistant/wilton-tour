<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public function leagues()
    {
    	return $this->belongsToMany('App\League', 'league_players');
    }

    public function matchWinners()
    {
    	return $this->belongsToMany('App\MatchWinners', 'match_winners');
    }

    public function matchScores()
    {
    	return $this->belongsToMany('App\MatchScores', 'match_scores');
    }
}
