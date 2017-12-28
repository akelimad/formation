<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\SessionRequest;
use App\Session;
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
        $sessions = Session::all();
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
        //dd(Carbon::createFromFormat('d/m/Y H:i', $request->start));
        $validator = Validator::make($request->all(), [
            'nom'            => 'required',
            'cour'           => 'required',
            'formateur'      => 'required',
            // 'start'          => 'required',
            // 'end'            => 'required|date|after:start',
            'methode'        => 'required',
            'statut'         => 'required',
            'salle'          => 'required',
            'participants'   => 'required',
        ]);
        $messages = $validator->errors();

        $occupee = \DB::table('sessions')
        ->select('start')
        ->where([
            'salle_id'=>$request->salle,
            'start'=>$request->start,
            'end'=>$request->end,
        ])->get();
        
        $now = Carbon::now()->format('Y-m-d h:i');
        if($occupee) {
            $messages->add('salle', 'La salle est reservée pour ces horaires!');
        }
        if($request->statut == "Terminé" && $request->end > $now) {
            $messages->add('horraire', 'La session ne peut être terminée sauf si la date fin est depassée !');
        }

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
        return view('sessions.show', ['s' => $session]);
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
        $validator = Validator::make($request->all(), [
            'nom'            => 'required',
            'cour'           => 'required',
            'formateur'      => 'required',
            // 'start'          => 'required|date',
            // 'end'            => 'required|date|after:start',
            'methode'        => 'required',
            'statut'         => 'required',
            'salle'          => 'required',
        ]);
        $messages = $validator->errors();

        $occupee = \DB::table('sessions')
        ->select('start')
        ->where([
            'salle_id'=>$request->salle,
            'start'=>$request->start,
            'end'=>$request->end,
        ])->get();
        
        $now = Carbon::now()->format('Y-m-d h:i');
        if($occupee) {
            $messages->add('salle', 'La salle est reservée pour ces horaires!');
        }
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

            if($participants){
                foreach ($participants as $par) {
                    if(!in_array($par, $prevus)){
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
                    \DB::table('Participant_session')->where(['session_id' => $session_id,'participant_id' =>$nv])->delete();
                }
            }
            return redirect('sessions');
        }
    }

    public function destroy(){
        
    }

    


}
