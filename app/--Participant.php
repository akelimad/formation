<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    /**
     * The sessions that belong to the participant.
     */
    public function sessions()
    {
        return $this->belongsToMany('App\Session');
    }
}
