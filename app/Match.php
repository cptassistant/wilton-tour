<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = ['league_id', 'date', 'course_id', 'statsIgnore', 'created_at', 'updated_at', 'holes_played', 'number_players', 'status'];
    
    public function matchScores()
    {
        return $this->hasMany('App\MatchScore');
    }

    public function matchHoles()
    {
        return $this->hasMany('App\MatchHole');
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
