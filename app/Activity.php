<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['title','description', 'date', 'condition', 'recurrence', 'time', 'URLimage', 'ideas_title', 'idea_description'];

    public function ideas() 
    {
        return $this->belongsTo(\App\Idea::class);
    }
}
