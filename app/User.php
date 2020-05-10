<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active', 'photo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //make relation between user and roles
    public function role(){
        return $this->belongsTo('App\Role');
    }

    // making relation between user and Photo
    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    //method for middleware
    public function isAdmin(){
        //if a role is null therefore no name, then do the try catch
        try {
            if($this->role->name == 'Administrator'){
                return true;
            }
            return false;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function isActive(){
        if($this->is_active == 1){
            return true;
        }
        return false;        
    }
    //end middleware

    //user can have multiple post
    public function post(){
        return $this->hasMany('App\Post');
    }

}
