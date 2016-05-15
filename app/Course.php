<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{    
    public function matches()
    {
    	return $this->hasMany('App\Match', 'course_id');
    }
}
