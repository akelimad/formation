<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salle extends Model
{
    public function session(){
        return $this->hasOne('App\Session');
    }
}
