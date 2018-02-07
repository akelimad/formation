<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Evaluation;
use App\Session;
use App\Reponse;
use App\User;
use App\User_sessions;
use App\Http\Requests;
use Mail;
use Carbon\Carbon; 
use DateTime;
use Illuminate\Support\Facades\Validator;

class EvaluationController extends Controller
{

    public function index(){
        $evaluations = \DB::table('evaluations')
            ->join('sessions', 'sessions.id', '=', 'evaluations.session_id')
            ->leftJoin('questions', 'questions.evaluation_id', '=', 'evaluations.id')
            ->select(array('evaluations.*', 'sessions.nom as session',\DB::raw("count(questions.id) as 'questionsCount'")))
            ->groupBy('evaluations.id')
            ->orderBy('evaluations.id', 'DESC')
            ->paginate(10);
        //dd($evaluations);
        return view('evaluations.index', ['evaluations'=>$evaluations]);
    }

    public function create(){
        ob_start();
        $sessions = Session::where('statut', '=', 'Terminé')->get();
        echo view('evaluations.create', ['sessions'=> $sessions]);
        $content = ob_get_clean();
        return ['title' => 'Ajouter une évaluation', 'content' => $content];
    }

    public function store(Request $request){
        $id = $request->input('id', false);
        $rules = [
            'nom'            => 'required|unique:evaluations',
            'type'           => 'required',
            'session'        => 'required',
        ];
        if($id) {
            $rules['nom'] = 'required|unique:evaluations,nom,'.$id;
            $validator = Validator::make($request->all(), $rules);
            $evaluation = Evaluation::find($id);
            $evaluation->nom=$request->nom;
            $evaluation->type=$request->type;
            $evaluation->session_id=$request->session;
            $evaluation->save();
        } else {
            $validator = Validator::make($request->all(), $rules);
            $messages = $validator->errors();
            $evaluations = Evaluation::where(['session_id' =>$request->session, 'type'=> $request->type])->get();
            if(count($evaluations) > 0){
                $messages->add('eval_exist', 'Il ya déjà une evaluation créée avec ces critères !');
            }
            if(count($messages)>0){ 
                return ["status" => "danger", "message" => $messages];
            }else{
                $evaluation = new Evaluation();
                $evaluation->nom=$request->input('nom');
                $evaluation->type=$request->input('type');
                $evaluation->session_id=$request->input('session');
                $evaluation->save();
            }
        }

        if($evaluation->save()) {
            return ["status" => "success", "message" => 'Les informations ont été sauvegardées avec succès.'];
        } else {
            return ["status" => "warning", "message" => 'Une erreur est survenue, réessayez plus tard.'];
        }

    }

    public function globalEvaluation(Request $request, $id, $type){
        $selected= $request->participant;
        $evaluation = Evaluation::find($id);
        $session = $evaluation->session;
        $part_presents = User_sessions::where(['session_id'=> $session->id, 'present'=>1])->get();
        $p_session = [];
        foreach ($part_presents as $part) {
            $p = User::find($part->user_id);
            $p_session[] = $p->name;
        }

        $s_id=$evaluation->session->id;
        $participants_repondus = \DB::table('session_user')
            ->join('sessions', 'sessions.id', '=', 'session_user.session_id')
            ->join('users', 'users.id', '=', 'session_user.user_id')
            ->join('reponses', 'reponses.participant_id', '=', 'users.id')
            ->select('users.*')
            ->where('sessions.id' ,'=', $s_id)
            ->groupBy('users.id')
            ->get();
        $p_repondus=[];
        foreach ($participants_repondus as $p_repondu) {
            $p_repondus[] = $p_repondu->name;
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
                'eval_nom' => $evaluation->nom,
                'session_nom' => $session->nom,
                'eval_type' => $evaluation->type == "a-chaud" ? "à chaud": "à froid",
                'participants_repondus' => $participants_repondus,
                'participants_nn_repondus' => $participants_nn_repondus,
                // 'sess_participants' => $part_presents,
                'selected' => $selected
            ]);
        }else{
            return redirect()->back()->with('no_response', "il n'ya aucune réponse sur cette évaluations !!!");
        }
    }

    public function edit($id){
        ob_start();
        $evaluation = Evaluation::find($id);
        $sessions = Session::where('statut', '=', 'Terminé')->get();
        echo view('evaluations.edit', ['e'=> $evaluation, 'sessions' => $sessions]);
        $content = ob_get_clean();
        return ['title' => "Modifier l'évaluation", 'content' => $content];
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'nom'            => 'required',
            'type'           => 'required',
        ]);

        $evaluation =  Evaluation::find($id);
        $evaluation->nom=$request->nom;
        $evaluation->type=$request->type;
        $evaluation->session_id=$request->session;
        $evaluation->save();
        if($evaluation->save()) {
            return ["status" => "success", "message" => 'Les informations ont été sauvegardées avec succès.'];
        } else {
            return ["status" => "warning", "message" => 'Une erreur est survenue, réessayez plus tard.'];
        }
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
            $part_presents = User_sessions::where(['session_id'=> $session->id, 'present'=>1])->get();
            if(count($part_presents)>0){
                $now = new DateTime();
                $end = new DateTime($session->end);
                $diff= $now->diff($end);
                if($evaluation->type == "a-chaud"){
                    foreach($part_presents as $part){
                        $p = User::find($part->user_id);
                        $sent = Mail::send('emails.send_survey', 
                            [
                                'civilite' => $p->civilite,
                                'session' => $session->nom, 
                                'participant'=>$p->name, 
                                'token'=> md5($p->id.$p->email.$evaluation->id),
                                'evaluation_id' => $evaluation->id,
                                'evaluation_type' => $eval_type
                            ]
                            , function ($m) use($p, $session){
                                $m->to($p->email, $p->name)->subject('Evaluation à chaud de la session '.$session->nom);
                        });
                    }
                    $evaluation->envoye_le= $now;
                    $evaluation->save();
                    return redirect()->back()->with('mails_sent', 'un email contenant le lien du questionnaire de cet évaluation: '.$evaluation->nom.'('.$eval_type.')'.' a bien été envoyé aux participants de la session: '.$session->nom);
                }
                if($evaluation->type == "a-froid" and $diff->m >=3){ // 3mois
                    foreach($part_presents as $part){
                        $p = User::find($part->user_id);
                        $sent = Mail::send('emails.send_survey', 
                            [
                                'civilite' => $p->civilite,
                                'session' => $session->nom, 
                                'participant'=>$p->name, 
                                'token'=> md5($p->id.$p->email.$evaluation->id),
                                'evaluation_id' => $evaluation->id,
                                'evaluation_type' => $eval_type
                            ]
                            , function ($m) use($p, $session){
                                $m->to($p->email, $p->name)->subject('Evaluation à froid de la session '.$session->nom);
                        });
                    }
                    $evaluation->envoye_le= $now;
                    $evaluation->save();
                    return redirect()->back()->with('mails_sent', 'un email contenant le lien du questionnaire de cette evaluation: '.$evaluation->nom.'('.$eval_type.')'.' a bien été envoyé aux participants de la session: '.$session->nom);
                }else{
                    return redirect()->back()->with('under_3month', "Attendez, les 3 mois pas encore depassés. ca fait maintenant juste ".$diff->m." mois et ".$diff->d." jours !!!");
                }
            }else{
                return redirect()->back()->with('no_participants', 'cet évaluation est liée à une session dont aucun participant ne fait partie.');
            }
        }else{
            return redirect()->back()->with('no_survey', "Aucun questionnaire n'a été crée pour cet évaluation. vous ne pouvez pas envoyer un email aux participants !!!");
        }

    }

    //rappeler par mail les participants qui n'ont pas repondus
    public function remembreMailParticipants($id){
        $evaluation = Evaluation::find($id);
        if($evaluation->type == "a-froid"){
            $eval_type= "à froid";
        }else if($evaluation->type == "a-chaud"){
            $eval_type= "à chaud";
        }
        $session = Session::find($evaluation->session_id);
        $part_presents = User_sessions::where(['session_id'=> $session->id, 'present'=>1])->get();
        $p_session = [];
        foreach ($part_presents as $p) {
            $p_session[] = $p->user_id;
        }

        $s_id=$evaluation->session->id;
        $participants_repondus = \DB::table('session_user')
            ->join('sessions', 'sessions.id', '=', 'session_user.session_id')
            ->join('users', 'users.id', '=', 'session_user.user_id')
            ->join('reponses', 'reponses.participant_id', '=', 'users.id')
            ->select('users.*')
            ->where('sessions.id' ,'=', $s_id)
            ->groupBy('users.id')
            ->get();
        $p_repondus=[];
        foreach ($participants_repondus as $p_repondu) {
            $p_repondus[] = $p_repondu->id;
        }

        $participants_nn_repondus =array_diff($p_session, $p_repondus);
        if(count($participants_nn_repondus)>0){
            //dd($participants_nn_repondus);
            foreach ($participants_nn_repondus as $participant) {
                $p = User::find($participant);
                $sent = Mail::send('emails.send_survey', 
                    [
                        'civilite' => $p->civilite,
                        'session' => $session->nom, 
                        'participant'=>$p->name, 
                        'token'=> md5($p->id.$p->email.$evaluation->id),
                        'evaluation_id' => $evaluation->id,
                        'evaluation_type' => $eval_type
                    ]
                    , function ($m) use($p){
                        $m->to($p->email, $p->name)->subject('Rappel évaluation à chaud');
                });
            }
            $now = new DateTime();
            $evaluation->rappele_le= $now;
            $evaluation->save();
            return redirect()->back()->with('remembre_mails_sent', 'un email contenant le lien du questionnaire de cet évaluation: '.$evaluation->nom.'('.$eval_type.')'.' a bien été envoyé aux participants de la session: '.$session->nom.' sur laquelle ils n\'ont pas repondu');
        }else{
            return redirect()->back()->with('all_answered', "Il n'ya aucun participant non répondu sur cet évaluation: ".$evaluation->nom."(".$eval_type.")"." de la session: ".$session->nom);
        }
    }


}
