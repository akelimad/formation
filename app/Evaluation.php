<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    public function session(){
        return $this->belongsTo('App\Session');
    }
    public function questions(){
        return $this->hasMany('App\Question');
    }
}
