<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reponse;
use App\Http\Requests;

class ReponsesController extends Controller
{
    public function store(Request $request){
        dd($_GET['token']);
        $reponses = array_combine($request->ids, $request->reponses);
        // $token_participant = 
        foreach ($reponses as $key => $value) {
            $reponse = new Reponse();
            $reponse->reponse = $value;
            $reponse->question_id = $key;
            $reponse->save();
        }
        return view('questionnaires.survey_success');
    }

}
