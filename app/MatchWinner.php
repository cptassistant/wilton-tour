<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchWinner extends Model
{
	protected $fillable = ['player_id', 'match_id', 'value'];

	public function player()
	{
		return $this->belongsTo('App\Player');
	}

	public function match()
	{
		return $this->belongsTo('App\Match');
	}
}
