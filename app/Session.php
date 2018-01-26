<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
 
class Session extends Model
{

    public function cour(){
        return $this->belongsTo('App\Cour');
    }
    public function formateur(){
        return $this->belongsTo('App\Formateur');
    }
    public function salle(){
        return $this->belongsTo('App\Salle');
    }
    public function budgets(){
        return $this->hasMany('App\Budget');
    }

    /**
     * The participants that belong to the session.
     */
    public function participants()
    {
        return $this->belongsToMany('App\User');
    }

    public function evaluations(){
        return $this->hasMany('App\Evaluation');
    }
}
