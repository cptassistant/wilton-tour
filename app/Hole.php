<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hole extends Model
{
	public function matchHoles()
    {
        return $this->hasMany('App\MatchHole');
    }

    public function scorecard()
    {
        return $this->belongsTo('App\Scorecard');
    }
}
