<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    public function matchWinners ()
    {
    	return $this->hasMany('App\MatchWinner', 'match_id');
    }

    public function matchAchievements ()
    {
    	return $this->hasMany('App\MatchAchievement', 'match_id');
    }

    public function league ()
    {
    	return $this->belongsTo('App\League');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function matchScores()
    {
        return $this->hasMany('App\MatchScore', 'match_id');
    }
}
