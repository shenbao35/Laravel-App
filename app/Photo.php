<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //accessor variable 
    protected $uploads = '/images/';

    protected $fillable = [
        'file'
    ];

    //accessor, must be named with get+colum name+attribute
    public function getFileAttribute($photo){
        return $this->uploads . $photo;
    }
}
