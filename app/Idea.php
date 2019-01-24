<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
	protected $fillable = ['title','description', 'URLimage'];



	public function activities() 
	{
    	return $this->hasMany(\App\Activity::class);
	}
}
