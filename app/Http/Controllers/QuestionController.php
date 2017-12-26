<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Reponse;
use App\Participant;
use App\Http\Requests;
use Mail;

class QuestionController extends Controller
{
    public function index(){
        return view('questionnaires.index');
    }

    public function questionnaire($id, $token){
        $q = Question::where('evaluation_id', $id)->get();
        return view('questionnaires.index',['questions' => $q, 'eval_id' => $id, 'token' => $token ]);
    }

    public function show($id){
        $q = Question::where('evaluation_id', $id)->get();
        return view('questionnaires.index',['questions' => $q ]);
    }

    public function create(){ 
        
    }

    public function store(Request $request){
        //dd($request->all());
        foreach ($request->questions as $q) {
            $question = new Question();
            $question->evaluation_id=$request->evaluation;
            $question->titre=$q;
            $question->save();
        }
        return redirect('evaluations');
    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }

    public function storeResponses(Request $request,$id, $token){
        $participants = Participant::all();

        foreach ($participants as $participant) {
            if(md5($participant->nom.$participant->email) == $token){
                $participant_email = $participant->email;
                $participant_nom = $participant->nom;
            }
        }


        $reponses = array_combine($request->ids, $request->reponses);
        // $token_participant = 
        foreach ($reponses as $key => $value) {
            $reponse = new Reponse();
            $reponse->reponse = $value;
            $reponse->question_id = $key;
            $reponse->save();
        }

        $sent = Mail::send('emails.confirm_participant', 
            [
                'participant'=>$participant_nom, 
            ]
            , function ($m) use($participant_email, $participant_nom){
                $m->to($participant_email, $participant_nom)->subject('Confirmation');
        });

        return view('questionnaires.survey_success');
    }
}
