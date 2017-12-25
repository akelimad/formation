<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function reponse(){
        return $this->hasOne('App\Reponse');
    }
}
