<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     protected $fillable = ['title','description', 'id_image'];



    public function comment() 
    {
        return $this->belongsTo(\App\Comment::class);
    }
 }
