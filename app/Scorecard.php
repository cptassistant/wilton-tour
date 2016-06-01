<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scorecard extends Model
{
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function holes()
    {
    	return $this->hasMany('App\Hole');
    }
}
