<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
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

    public function chaudEvaluation($id){
        $reponses = \DB::table('questions')
            ->join('evaluations', 'evaluations.id', '=', 'questions.evaluation_id')
            ->join('reponses', 'reponses.question_id', '=', 'questions.id')
            ->select(array('evaluations.id','questions.titre', 'reponses.question_id', \DB::raw("TRUNCATE(sum(reponses.reponse)/count(reponses.reponse), 1) as 'total'")))
            ->where('evaluations.id','=',$id)
            ->groupBy('reponses.question_id')
            ->orderBy('reponses.question_id')
            ->get();
        if($reponses){
            foreach ($reponses as $r) {
                $note[]= $r->total;
            }
            $note = bcdiv(array_sum($note)/count($note) , 1, 1);// bcdiv(2.56789, 1, 2);  // 2.56
            $floor_note = floor($note * 2) / 2; 
            return view('evaluations.a_chaud', ['reponses' => $reponses,'note_floor'=>$floor_note, 'note' => $note]);
        }else{
            die('ya pas de reponses');
            return Redirect::back()->withErrors(["Personne n'a repondu a cette evaluations !!!"]);
        }
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
                $sent = Mail::send('emails.send-to-participants', 
                    [
                        'session' => $session->nom, 
                        'participant'=>$p->nom, 
                        'token'=> md5($p->nom.$p->email),
                        'evaluation_id' => $evaluation->id
                    ]
                    , function ($m) use($p){
                        $m->to($p->email, $p->nom)->subject('Evaluation à chaud');
                });
            }
            return redirect()->back()->with('mails_sent', 'un email contenant le lien du questionnaire de cette evaluation: '.$evaluation->nom.' a bien été envoyé aux participants de la session: '.$session->nom);
        }else{
            return redirect()->back()->with('no_participants', 'cette evaluation est liée à une session dont aucun participant ne fait partie.');
        }
    }


}
