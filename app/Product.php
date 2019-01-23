<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = ['type','title','description','price','URLimage'];
     protected $dates = ['expired_at'];
}
