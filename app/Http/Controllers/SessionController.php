<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\SessionRequest;
use App\Session;
use App\Reponse;
use App\Participant_sessions;
use App\Formateur;
use App\Salle;
use App\Participant;
use App\Cour; 
use App\Http\Requests;
use Carbon\Carbon; 


class SessionController extends Controller
{
    public function index(){
        $sessions = Session::orderBy('id', 'DESC')->get();
        return view('sessions.index', ['sessions'=>$sessions]);
    }

    public function create(){
        $cours = Cour::all();
        $formateurs = Formateur::all();
        $salles = Salle::all();
        $participants = Participant::all();
        return view('sessions.create', [
            'cours'=> $cours,
            'formateurs'=> $formateurs,
            'salles'=> $salles,
            'participants'=> $participants,
        ]);
    }

    public function store(SessionRequest $request){
        $start = Carbon::createFromFormat('d/m/Y H:i', $request->start);
        $end = Carbon::createFromFormat('d/m/Y H:i', $request->end);
        $validator = Validator::make($request->all(), [
            'nom'            => 'required|unique:sessions',
            'cour'           => 'required',
            'formateur'      => 'required',
            'lieu'           => 'required',
            'methode'        => 'required',
            'statut'         => 'required',
            'salle'          => 'required',
            'participants'   => 'required',
        ]);
        $messages = $validator->errors();

        $salle_occupee = \DB::table('sessions')
        ->select('start')
        ->where([
            'salle_id'=>$request->salle,
            'start'=>$start,
            'end'=>$end,
        ])->get();

        $formateur_occupe = \DB::table('sessions')
        ->select('formateur_id')
        ->where([
            'formateur_id'=>$request->formateur,
            'start'=>$start,
            'end'=>$end,
        ])->get();

        
        $now = Carbon::now()->format('Y-m-d h:i');
        if($salle_occupee) {
            $messages->add('salle', 'La salle est reservée pour ces horaires!');
        }
        if($formateur_occupe) {
            $messages->add('formateur', 'Le formateur affecté n\'est pas disponible pour ces dates!');
        }
        if($request->statut == "Terminé" && $request->end > $now) {
            $messages->add('horraire', 'La session ne peut être terminée sauf si la date fin est depassée !');
        }

        //dd($formateur_occupe);

        if(count($messages)>0){ 
            return redirect('sessions/create')->withErrors($messages)->withInput();
        }else{
            $session = new Session();
            $session->nom=$request->input('nom');
            $session->description=$request->input('description');
            $session->start=Carbon::createFromFormat('d/m/Y H:i', $request->start);
            $session->end=Carbon::createFromFormat('d/m/Y H:i', $request->end);
            $session->lieu=$request->input('lieu');
            $session->methode=$request->input('methode');
            $session->cour_id=$request->input('cour');
            $session->salle_id=$request->input('salle');
            $session->formateur_id=$request->input('formateur');
            $session->statut=$request->input('statut');
            $session->save();

            $session_id = $session->id;
            $participants=array();
            $participants= $request->participants;
            if($participants){
                foreach ($participants as $par) {
                    $sess_participants= new Participant_sessions();
                    $sess_participants->session_id = $session_id;
                    $sess_participants->participant_id = $par;
                    $sess_participants->prevu = 1;
                    $sess_participants->present = 1;
                    $sess_participants->save();
                }
            }
            return redirect('sessions');
        }

    }

    public function show($id){
        $session = Session::find($id);
        $p_presents = \DB::table('participant_session')
            ->join('sessions', 'sessions.id', '=', 'participant_session.session_id')
            ->join('participants', 'participants.id', '=', 'participant_session.participant_id')
            ->select('participants.*')
            ->where('participant_session.session_id','=',$session->id)
            ->where('participant_session.present','=',1)
            ->get();
        return view('sessions.show', ['s' => $session, 'p_presents' => $p_presents]);
    }

    public function edit($id){
        $cours = Cour::all();
        $formateurs = Formateur::all();
        $salles = Salle::all();
        $participants = Participant::all();
        $session = Session::find($id);

        $prevus = [];
        $presents = [];
        $p_prevus = Participant_sessions::where(['session_id'=> $id, 'prevu'=>1])->get();
        $p_presents = Participant_sessions::where(['session_id'=> $id, 'present'=>1])->get();
        //dd($p_presents);
        foreach ($p_prevus as $p) {
            $prevus[] = $p->participant_id;
        }
        foreach ($p_presents as $p) {
            $presents[] = $p->participant_id;
        }

        //dd($presents);

        return view('sessions.edit', [
            'cours'=> $cours,
            'formateurs'=> $formateurs,
            'salles'=> $salles,
            'participants'=> $participants,
            's'=> $session,
            'prevus_ids'=> $prevus,
            'present_ids'=> $presents,
        ]);
    }

    public function update(SessionRequest $request, $id){
        $start = Carbon::createFromFormat('d/m/Y H:i', $request->start);
        $end = Carbon::createFromFormat('d/m/Y H:i', $request->end);
        $validator = Validator::make($request->all(), [
            'nom'            => 'required',
            'cour'           => 'required',
            'formateur'      => 'required',
            'lieu'           => 'required',
            'methode'        => 'required',
            'statut'         => 'required',
            'salle'          => 'required',
        ]);
        $messages = $validator->errors();

        // $salle_occupee = \DB::table('sessions')
        // ->select('start')
        // ->where([
        //     'salle_id'=>$request->salle,
        //     'start'=>$start,
        //     'end'=>$end,
        // ])->get();

        // $formateur_occupe = \DB::table('sessions')
        // ->select('formateur_id')
        // ->where([
        //     'formateur_id'=>$request->formateur,
        //     'start'=>$start,
        //     'end'=>$end,
        // ])->get();
        
        $now = Carbon::now()->format('Y-m-d h:i');
        // if($salle_occupee) {
        //     $messages->add('salle', 'La salle est reservée pour ces horaires!');
        // }
        if($request->statut == "Terminé" && $request->end > $now){
            $messages->add('horraire', 'La session ne peut être terminée sauf si la date fin est depassée !');
        }

        $prevus = [];
        $presents = [];
        $p_prevus = Participant_sessions::where(['session_id'=> $id, 'prevu'=>1])->get();
        $p_presents = Participant_sessions::where(['session_id'=> $id, 'present'=>1])->groupBy('participant_id')->get();
        foreach ($p_prevus as $p) {
            $prevus[] = $p->participant_id;
        }
        foreach ($p_presents as $p) {
            $presents[] = $p->participant_id;
        }

        if(count($messages)>0){
            return redirect('sessions/'.$id.'/edit')->withErrors($messages)->withInput();
        }else{
            $session = Session::find($id);
            $session->nom=$request->input('nom');
            $session->description=$request->input('description');
            $session->start=Carbon::createFromFormat('d/m/Y H:i', $request->start);
            $session->end=Carbon::createFromFormat('d/m/Y H:i', $request->end);
            $session->lieu=$request->input('lieu');
            $session->methode=$request->input('methode');
            $session->cour_id=$request->input('cour');
            $session->salle_id=$request->input('salle');
            $session->formateur_id=$request->input('formateur');
            $session->statut=$request->input('statut');
            $session->save();

            $session_id = $session->id;
            $participants=array();
            $participants= $request->participants;
            $sess_par= $session->participants;
            foreach ($sess_par as $s_p) {
                $sp_ids[] = $s_p->id;
            }
            //dd($sp_ids);
            if($participants){
                foreach ($participants as $par) {
                    if(!in_array($par, $prevus) and !in_array($par, $sp_ids)){
                        $sess_participants= new Participant_sessions();
                        $sess_participants->session_id = $session_id;
                        $sess_participants->participant_id = $par;
                        $sess_participants->present = 1;
                        $sess_participants->save();  
                    }
                }
            }
            if(!empty($presents) && !empty($request->participants)){
                $nouveau_presents=array_diff($presents, $request->participants); 
                foreach ($nouveau_presents as $nv) {
                    \DB::table('participant_session')
                    ->where(['session_id' => $session_id,'participant_id' =>$nv])
                    ->update(['present'=>0]);
                }
            }
            return redirect('sessions');
        }
    }

    public function destroy($id){
        $session = Session::find($id);
        if($session->budgets){
            foreach($session->budgets as $budget){
                $budget->delete();
            }  
        }
        if($session->evaluations){
            foreach($session->evaluations as $evaluation){
                foreach ($evaluation->questions as $question) {
                    $reponses = Reponse::where(['question_id' => $question->id])->get();
                    foreach ($reponses as $reponse) {
                        $reponse->delete();          
                    }
                    $question->delete();
                }
                $evaluation->delete();
            }  
        }
        //$parts_sess = Participant_sessions::where(['session_id'=> $session->id])->get();
        // if($session->participants){
        //     foreach($session->participants as $part_sess){
        //         $part_sess->detach();
        //     }  
        // }
        $session->participants()->detach();
        $session->delete();
        return redirect('sessions');
    }

    public function filterSessions(Request $request){
        $criteres = [];
        if ( !empty($request->start and empty($request->end)) ) {
            $start = Carbon::createFromFormat('d/m/Y H:i', $request->start);
            $criteres= ['start' => $start];
        }else if( !empty($request->end and empty($request->start)) ){
            $end = Carbon::createFromFormat('d/m/Y H:i', $request->end);
            $criteres= ['end' => $end];
        }else if( !empty($request->start and !empty($request->end)) ){
            $start = Carbon::createFromFormat('d/m/Y H:i', $request->start)->toDateTimeString();
            $end = Carbon::createFromFormat('d/m/Y H:i', $request->end)->toDateTimeString();
            $criteres= ['start' => $start, 'end'=> $end]; //empty($request->start && empty($request->end))
        }else if( !empty($request->statut) ){
            $criteres= ['statut' => $request->statut];
        }
        
        $selected= $request->statut;
        $selected_start = $request->start;
        $selected_end = $request->end;
        $sessions = Session::where($criteres)->get();
        //dd($sessions);
        return view('sessions.index', compact('selected','sessions','selected_start', 'selected_end'));
    }


}
