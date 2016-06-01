<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{    

	public function matches()
	{
		return $this->hasMany('App\Match');
	}

	public function scorecards()
	{
		return $this->hasMany('App\Scorecard');
	}
}
