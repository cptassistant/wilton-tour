<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
	protected $fillable = ['name', 'tagline', 'country', 'state', 'city'];

	public function owner()
	{
		return $this->hasOne('App\User', 'id', 'ownerID');
	}

    public function players()
    {
    	return $this->belongsToMany('App\Player', 'league_players');
    }

    public function achievements()
    {
        return $this->belongsToMany('App\Achievement', 'league_achievements');
    }

    public function matches()
    {
    	return $this->hasMany('App\Match', 'league_id');
    }

    public function rules()
    {
        return $this->hasMany('App\Rule', 'league_id');
    }
}
