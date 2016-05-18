<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchWinner extends Model
{
	public function player()
	{
		return $this->belongsTo('App\Player');
	}
}
