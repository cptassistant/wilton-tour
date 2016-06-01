<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchScore extends Model
{    
	public function match()
	{
		return $this->belongsTo('App\Match');
	}

	public function player()
	{
		return $this->belongsTo('App\Player');
	}

	public function matchHole()
	{
		return $this->belongsTo('App\MatchHole');
	}
}
