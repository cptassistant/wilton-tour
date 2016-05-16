<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hole extends Model
{
    public function Holes()
    {
        return $this->hasMany('App\Hole', 'hole_id');
    }
}
