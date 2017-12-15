<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Session_participants;
use App\Formateur;
use App\Salle;
use App\Cour;
use App\Http\Requests;

class SessionController extends Controller
{
    public function index(){
        $sessions = \DB::table('sessions')
            ->join('cours', 'cours.id', '=', 'sessions.cour_id')
            ->join('formateurs', 'formateurs.id', '=', 'sessions.formateur_id')
            ->select('sessions.*', 'cours.titre as titreCour', 'formateurs.nom as nomFormateur')
            ->get();

        return view('sessions.index', ['sessions'=>$sessions]);
    }

    public function index_session_participant(){
        $sessions = \DB::table('sessions')
            ->join('cours', 'cours.id', '=', 'sessions.cour_id')
            ->join('formateurs', 'formateurs.id', '=', 'sessions.formateur_id')
            ->join('session_participants', 'session_participants.session_id', '=', 'sessions.id')
            ->select('sessions.*', 'cours.titre as titreCour', 'formateurs.nom as nomFormateur', 'session_participants.*')
            ->get();

        //dd($sessions);
        return view('sessions.session_participants', [
            'sessions'=>$sessions,
            'participants', $sessions
        ]);
    }

    public function create(){
        $cours = Cour::all();
        $formateurs = Formateur::all();
        $salles = Salle::all();
        return view('sessions.create', [
            'cours'=> $cours,
            'formateurs'=> $formateurs,
            'salles'=> $salles,
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
        $session->formateur_id=$request->input('formateur');
        $session->statut=$request->input('statut');
        $session->save();

        
        $session_id = $session->id;
        $participants= array();
        $participants = explode(',', $request->participants);
        //dd($participants);
        $arr = array();

        foreach ($participants as $par) {
            $participant_id = \DB::table('participants')
            ->select('id')->where('nom','=', $par)
            ->first();
            $sess_participants= new Session_participants();
            $sess_participants->session_id = $session_id;
            $sess_participants->participant_id = $participant_id->id;
            $sess_participants->save();
        }


        return redirect('sessions');

    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
