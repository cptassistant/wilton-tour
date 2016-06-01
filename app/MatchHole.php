<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchHole extends Model
{
    public function match()
	{
		return $this->belongsTo('App\Match');
	}

	public function hole()
	{
		return $this->belongsTo('App\Hole');
	}

	public function matchScores()
	{
		return $this->hasMany('App\MatchScore', 'match_holes_id');
	}
}
