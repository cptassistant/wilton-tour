<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchWinner extends Model
{
    public function player()
	{
		return $this->hasOne('App\Player', 'id', 'player_id');
	}

	public function match()
	{
		return $this->belongsTo('App\Match');
	}
}
