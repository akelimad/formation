<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Participant_sessions;
use App\Formateur;
use App\Salle;
use App\Participant;
use App\Cour;
use App\Http\Requests;

class SessionController extends Controller
{
    public function index(){
        $sessions = Session::all();
        //dd($sessions);
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

    public function store(Request $request){
        $session = new Session();
        $session->nom=$request->input('nom');
        $session->description=$request->input('description');
        $session->start=$request->input('start');
        $session->end=$request->input('end');
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

        foreach ($participants as $par) {
            $sess_participants= new Participant_sessions();
            $sess_participants->session_id = $session_id;
            $sess_participants->participant_id = $par;
            $sess_participants->save();
        }

        return redirect('sessions');

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

        $pids = [];
        $ps = Participant_sessions::where('session_id', $id)->get();
        foreach ($ps as $p) {
            $pids[] = $p->participant_id;
        }

        return view('sessions.edit', [
            'cours'=> $cours,
            'formateurs'=> $formateurs,
            'salles'=> $salles,
            'participants'=> $participants,
            's'=> $session,
            'pids'=> $pids,
        ]);
    }

    public function update(Request $request, $id){
        $session = Session::find($id);
        $session->nom=$request->input('nom');
        $session->description=$request->input('description');
        $session->start=$request->input('start');
        $session->end=$request->input('end');
        $session->lieu=$request->input('lieu');
        $session->methode=$request->input('methode');
        $session->cour_id=$request->input('cour');
        $session->salle_id=$request->input('salle');
        $session->formateur_id=$request->input('formateur');
        $session->statut=$request->input('statut');
        $session->save();

        $pids = [];
        $ps = Participant_sessions::where('session_id', $id)->get();
        foreach ($ps as $p) {
            $pids[] = $p->participant_id;
        }

        $session_id = $session->id;
        $participants=array();
        $participants= $request->participants;
        foreach ($participants as $par) {
            if(!in_array($par, $pids)){
                $sess_participants= new Participant_sessions();
                $sess_participants->session_id = $session_id;
                $sess_participants->participant_id = $par;
                $sess_participants->statut = 'Present';
                $sess_participants->save();  
            }
        }

        return redirect('sessions');
    }

    public function destroy(){
        
    }
}
