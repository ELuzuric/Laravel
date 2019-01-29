<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageComment extends Model
{
    protected $fillable = [
        'id_image','URLimage','activity_id'
    ];

     public function activity() 
    {
        return $this->belongsTo(\App\Activity::class);
    }
}
