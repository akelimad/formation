<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Evaluation;
use App\Session;
use App\Reponse;
use App\Particicpant;
use App\Http\Requests;
use Mail;
use Carbon\Carbon; 
use DateTime;
class EvaluationController extends Controller
{

    public function index(){
        $evaluations = \DB::table('evaluations')
            ->join('sessions', 'sessions.id', '=', 'evaluations.session_id')
            ->select('evaluations.*', 'sessions.nom as session')
            ->orderBy('evaluations.id', 'DESC')
            ->get();
        return view('evaluations.index', ['evaluations'=>$evaluations]);
    }

    public function create(){
        $sessions = Session::where('statut', '=', 'Terminé')->get();
        return view('evaluations.create', ['sessions'=> $sessions]);
    }

    public function store(Request $request){
        $evaluation = new Evaluation();
        $evaluation->nom=$request->input('nom');
        $evaluation->type=$request->input('type');
        $evaluation->session_id=$request->input('session');
        $evaluation->save();
        return redirect('evaluations');

    }

    public function globalEvaluation(Request $request, $id, $type){
        $selected= $request->participant;
        $evaluation = Evaluation::find($id);
        $sess_participants=$evaluation->session->participants;
        $p_session = [];
        foreach ($sess_participants as $p) {
            $p_session[] = $p->nom;
        }

        $s_id=$evaluation->session->id;
        $participants_repondus = \DB::table('participant_session')
            ->join('sessions', 'sessions.id', '=', 'participant_session.session_id')
            ->join('participants', 'participants.id', '=', 'participant_session.participant_id')
            ->join('reponses', 'reponses.participant_id', '=', 'participants.id')
            ->select('participants.*')
            ->where('sessions.id' ,'=', $s_id)
            ->groupBy('participants.id')
            ->get();
        $p_repondus=[];
        foreach ($participants_repondus as $p_repondu) {
            $p_repondus[] = $p_repondu->nom;
        }

        $participants_nn_repondus =array_diff($p_session, $p_repondus);

        if($request->participant){
            $reponses = \DB::table('questions')
            ->join('evaluations', 'evaluations.id', '=', 'questions.evaluation_id')
            ->join('reponses', 'reponses.question_id', '=', 'questions.id')
            ->select(array('evaluations.id','questions.titre', 'reponses.question_id', \DB::raw("TRUNCATE(sum(reponses.reponse)/count(reponses.reponse), 1) as 'total'")))
            ->where(['evaluations.id'=>$id,'reponses.participant_id'=>$request->participant])
            ->groupBy('reponses.question_id')
            ->orderBy('reponses.question_id')
            ->get();
        }else{
            $reponses = \DB::table('questions')
            ->join('evaluations', 'evaluations.id', '=', 'questions.evaluation_id')
            ->join('reponses', 'reponses.question_id', '=', 'questions.id')
            ->select(array('evaluations.id','questions.titre', 'reponses.question_id', \DB::raw("TRUNCATE(sum(reponses.reponse)/count(reponses.reponse), 1) as 'total'")))
            ->where('evaluations.id','=',$id)
            ->groupBy('reponses.question_id')
            ->orderBy('reponses.question_id')
            ->get();
        }

        if($reponses){
            foreach ($reponses as $r) {
                $note[]= $r->total;
            }
            $note = bcdiv(array_sum($note)/count($note) , 1, 1);// bcdiv(2.56789, 1, 2);  // 2.56
            $floor_note = floor($note * 2) / 2;  // 4.2 => 4 ou 4.7=> 4.5
            $taux = ($note*100)/5;
            return view('evaluations.a_chaud', [
                'reponses' => $reponses,
                'note_floor'=>$floor_note, 
                'note' => $note, 
                'taux'=>$taux,
                'eval_id' => $evaluation->id,
                'eval_type' => $evaluation->type,
                'participants_repondus' => $participants_repondus,
                'participants_nn_repondus' => $participants_nn_repondus,
                'sess_participants' => $sess_participants,
                'selected' => $selected
            ]);
        }else{
            return redirect()->back()->with('no_response', "il n'ya aucune réponse sur cette evaluations !!!");
        }
    }

    public function edit($id){
        $evaluation = Evaluation::find($id);
        $sessions = Session::where('statut', '=', 'Terminé')->get();
        return view('evaluations.edit', ['e'=> $evaluation, 'sessions' => $sessions]);
    }

    public function update(Request $request, $id){
        $evaluation =  Evaluation::find($id);
        $evaluation->nom=$request->input('nom');
        $evaluation->type=$request->input('type');
        $evaluation->session_id=$request->input('session');
        $evaluation->save();
        return redirect('evaluations');
    }

    public function destroy(Request $request, $id){
        $evaluation = Evaluation::find($id);
        foreach ($evaluation->questions as $question) {
            $reponses = Reponse::where(['question_id' => $question->id])->get();
            foreach ($reponses as $reponse) {
                $reponse->delete();          
            }
            $question->delete();
        }
        $evaluation->delete();
        session()->flash("success", "The product has been deleted successfully !");
        return redirect('evaluations');
    }

    public function sendMailParticipants($id){
        $evaluation = Evaluation::find($id);
        if($evaluation->type == "a-froid"){
            $eval_type= "à froid";
        }else if($evaluation->type == "a-chaud"){
            $eval_type= "à chaud";
        }
        //dd($evaluation->questions);
        if(count($evaluation->questions)>0){
            $session = Session::find($evaluation->session_id);
            if(count($session->participants)>0){
                $now = new DateTime();
                $end = new DateTime($session->end);
                $diff= $now->diff($end);
                if($evaluation->type == "a-chaud"){
                    foreach($session->participants as $p){
                        $sent = Mail::send('emails.send-to-participants', 
                            [
                                'session' => $session->nom, 
                                'participant'=>$p->nom, 
                                'token'=> md5($p->id.$p->email),
                                'evaluation_id' => $evaluation->id,
                                'evaluation_type' => $eval_type
                            ]
                            , function ($m) use($p){
                                $m->to($p->email, $p->nom)->subject('Evaluation à chaud');
                        });
                    }
                    return redirect()->back()->with('mails_sent', 'un email contenant le lien du questionnaire de cette evaluation: '.$evaluation->nom.'('.$eval_type.')'.' a bien été envoyé aux participants de la session: '.$session->nom);
                }
                if($evaluation->type == "a-froid" and $diff->m >=3){ // 3mois
                    foreach($session->participants as $p){
                        $sent = Mail::send('emails.send-to-participants', 
                            [
                                'session' => $session->nom, 
                                'participant'=>$p->nom, 
                                'token'=> md5($p->id.$p->email),
                                'evaluation_id' => $evaluation->id,
                                'evaluation_type' => $eval_type
                            ]
                            , function ($m) use($p){
                                $m->to($p->email, $p->nom)->subject('Evaluation à froid');
                        });
                    }
                    return redirect()->back()->with('mails_sent', 'un email contenant le lien du questionnaire de cette evaluation: '.$evaluation->nom.'('.$eval_type.')'.' a bien été envoyé aux participants de la session: '.$session->nom);
                }else{
                    return redirect()->back()->with('under_3month', "Attendez, les 3 mois pas encore depassés. ca fait maintenant juste ".$diff->m." mois et ".$diff->d." jours !!!");
                }
            }else{
                return redirect()->back()->with('no_participants', 'cette evaluation est liée à une session dont aucun participant ne fait partie.');
            }
        }else{
            return redirect()->back()->with('no_survey', "Aucun questionnaire n'a été crée pour cette evaluation. vous ne pouvez pas envoyer un email aux participants !!!");
        }

    }


}
