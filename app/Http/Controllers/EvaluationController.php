<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evaluation;
use App\Session;
use App\Http\Requests;
use Mail;

class EvaluationController extends Controller
{
    public function index(){
        $evaluations = \DB::table('evaluations')
            ->join('sessions', 'sessions.id', '=', 'evaluations.session_id')
            ->select('evaluations.*', 'sessions.nom as session')
            ->get();
        return view('evaluations.index', ['evaluations'=>$evaluations]);
    }

    public function create(){
        $sessions = Session::all();
        return view('evaluations.create', ['sessions'=> $sessions]);
    }

    public function store(Request $request){

        $cour = new Evaluation();
        $cour->nom=$request->input('nom');
        $cour->type=$request->input('type');
        $cour->session_id=$request->input('session');
        $cour->save();
        return redirect('evaluations');

    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }

    public function sendMailParticipants($id){
        $evaluation = Evaluation::find($id);
        $session = Session::find($evaluation->session_id);

        if(count($session->participants)>0){
            foreach($session->participants as $p){
                $sent = Mail::send('emails.send-to-participants', ['session' => $session->nom, 'participant'=>$p->nom, 'token'=> md5($p->nom.$p->email)], function ($m) use($p){
                    $m->to($p->email, $p->nom)->subject('nouvaeau questionnaire');
                });
            }
            return redirect()->back()->with('mails_sent', 'un email contenant le lien du questionnaire de cette evaluation: '.$evaluation->nom.' a bien été envoyé aux participants de la session: '.$session->nom);
        }else{
            return redirect()->back()->with('no_participants', 'cette evaluation est liée à une session dont aucun participant ne fait partie.');
        }
    }


}
