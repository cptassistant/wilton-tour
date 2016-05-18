<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public function matchScores()
    {
        return $this->hasMany('App\MatchScore');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function matchStats()
    {
        return $this->hasMany('App\MatchStat');
    }

    public function matchWinners()
    {
        return $this->hasMany('App\MatchWinner');
    }
}
