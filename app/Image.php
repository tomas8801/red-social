<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

    protected $table = 'images';

//    one to many relation
    public function comments() {
        return $this->hasMany('App\Comment')->orderBy('id', 'desc');
    }
    
//    one to many relation
    public function likes(){
        return $this->hasMany('App\Like');
    }

//    many to one relation
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

}
