<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
     
    public function session(){
        return $this->hasOne('App\Session');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
