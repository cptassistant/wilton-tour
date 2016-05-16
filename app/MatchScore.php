<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchScore extends Model
{    
	public function match()
	{
		return $this->belongsTo('App\Match');
	}

	public function hole()
	{
		return $this->belongsTo('App\Hole');
	}

	public function player()
	{
		return $this->belongsTo('App\Player');
	}
}
