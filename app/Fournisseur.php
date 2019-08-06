<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{

    public function formateurs(){
        return $this->hasMany('App\Formateur');
    }

}
