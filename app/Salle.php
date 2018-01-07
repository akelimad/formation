<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    public function sessions(){
        return $this->hasMany('App\Session');
    }
}
