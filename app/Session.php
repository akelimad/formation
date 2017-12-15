<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    public function cours(){
        return $this->hasMany('App\Cour');
    }

    public function formateurs(){
        return $this->hasMany('App\Formateur');
    }
}
 