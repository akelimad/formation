<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Reponse;
use App\Token;
use App\Participant;
use App\Evaluation;
use App\Http\Requests;
use Mail;

class QuestionController extends Controller
{
    public function index(){
        return view('questionnaires.index');
    }

    public function questionnaire($id, $token){
        $q = Question::where('evaluation_id', $id)->get();
        $tokens = Token::where(['token' => $token])->get();
        if(count($tokens) > 0){
            return view('questionnaires.already_answred');
        }else{
            return view('questionnaires.index',['questions' => $q, 'eval_id' => $id, 'token' => $token ]);
        }
    }

    public function show($id){
        $q = Question::where('evaluation_id', $id)->get();
        return view('questionnaires.show',['questions' => $q ]);
    }

    public function create(){ 
        $evaluations= Evaluation::select('id', 'nom')->get();
        return view('questionnaires.create', compact('evaluations'));
    }

    public function store(Request $request){
        //dd($request->all());
        foreach ($request->questions as $q) {
            $question = new Question();
            $question->evaluation_id=$request->evaluation;
            $question->titre=$q;
            $question->save();
        }
        $url=url('questionnaire/'.$request->evaluation);
        return redirect('evaluations')
        ->with('survey_add',"Le questionnaire a bien été ajouté. vous pouvez le <a href='$url'>consulter</a> ");
    }

    public function edit($id){
        $evaluation = Evaluation::find($id);
        $first_question = $evaluation->questions->first();
        $eval_questions = $evaluation->questions;
        return view('questionnaires.edit', compact('eval_questions','evaluation','first_question'));
    }

    public function update(Request $request, $id){
        $e = Evaluation::find($id);
        foreach ($e->questions as $q) {
            $q->delete();
        }

        foreach ($request->questions as $qst) {
            $question = new Question();
            $question->evaluation_id=$request->evaluation;
            $question->titre=$qst;
            $question->save();
        }
        $url=url('questionnaire/'.$request->evaluation);
        return redirect('evaluations')
        ->with('survey_add',"Le questionnaire a bien été modifié. vous pouvez le <a href='$url'>consulter</a> ");
    }

    public function destroy($id){
        $e = Evaluation::find($id);
        foreach ($e->questions as $q) {
            $q->delete();
        }
        return redirect('evaluations');
    }

    public function storeResponses(Request $request,$id, $token){
        $participants = Participant::all();
        $evaluation = Evaluation::find($id);
        if($evaluation->type == "a-froid"){
            $eval_type= "à froid";
        }else if($evaluation->type == "a-chaud"){
            $eval_type= "à chaud";
        }
        foreach ($participants as $participant) {
            if(md5($participant->id.$participant->email.$evaluation->id) == $token){
                $participant_email = $participant->email;
                $participant_nom = $participant->nom;
                $participant_id = $participant->id;
            } 
        }

        $reponses = array_combine($request->questionsIds, $request->reponses);
        foreach ($reponses as $key => $value) {
            $reponse = new Reponse();
            $reponse->reponse = $value;
            $reponse->question_id = $key;
            $reponse->participant_id = $participant_id;
            $reponse->save();
        }
        $t = new Token();
        $t->token= $token;
        $t->status = 1;
        $t->save();

        $sent = Mail::send('emails.confirm_participant', 
            [
                'participant'=>$participant_nom, 
                'eval_type'=>$eval_type 
            ]
            , function ($m) use($participant_email, $participant_nom){
                $m->to($participant_email, $participant_nom)->subject('Confirmation');
        });

        return view('questionnaires.survey_success');
    }
}
