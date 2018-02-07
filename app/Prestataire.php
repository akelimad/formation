<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestataire extends Model
{

    public function formateurs(){
        return $this->hasMany('App\Formateur');
    }

}
