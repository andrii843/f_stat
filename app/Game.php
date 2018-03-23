<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
    	'name', 'date', 'note', 'users'
	];

    public function users()
	{
		return $this->belongsToMany('App\User');
	}

    public function ratings()
	{
		return $this->hasMany('App\Rating');
	}
}
