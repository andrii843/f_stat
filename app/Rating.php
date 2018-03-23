<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
	protected $fillable = ['ratings'];

    public function game()
	{
		return $this->belongsTo('App\Game');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}
}