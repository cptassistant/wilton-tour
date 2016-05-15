<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    public function leagues()
    {
    	return $this->belongsToMany('App\League', 'league_achievements');
    }
}
