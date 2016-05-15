<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchScore extends Model
{    
	public function match()
	{
		return $this->belongsTo('App\Match');
	}
}
