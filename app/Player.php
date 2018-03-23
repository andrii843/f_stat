<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
    	'average_rating', 'count_rating'
	];

    public function user()
	{
		return $this->belongsTo('App\User');
	}

    public function ratings()
	{
		return $this->hasMany('App\Rating');
	}
}
