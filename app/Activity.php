<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Activity extends Model
{
    protected $fillable = ['title','description', 'date', 'condition', 'recurrence', 'time', 'URLimage', 'ideas_title', 'idea_description'];


   
}
