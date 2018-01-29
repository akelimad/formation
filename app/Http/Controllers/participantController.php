<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Session;
use App\User_sessions;
use App\Cour;
use App\Http\Requests;

class ParticipantController extends Controller
{

    public function index(){
        $participants = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'collaborateur');
        })->paginate(10);
        return view('participants.index', ['participants'=>$participants]);
    }

    public function create(){
        ob_start();
        echo view('participants.create');
        $content = ob_get_clean();
        return ['title' => 'Ajouter un participant', 'content' => $content];
    }

    public function store(Request $request){
        $id = $request->input('id', false);
        if($id) {
            $rules = [
                'nom'            => 'required',
                'email'          => 'required',
            ];
            $validator = \Validator::make($request->all(), $rules);
            $participant = User::find($id);
        } else {
            $rules = [
                'nom'            => 'required',
                'email'          => 'required|unique:users',
            ];
            $validator = \Validator::make($request->all(), $rules);
            $participant = new User();
        }
        if ($validator->fails()) {
            return ["status" => "danger", "message" => $validator->errors()->all()];
        }
        
        $participant->name=$request->input('nom');
        $participant->email=$request->input('email');
        $participant->password= bcrypt("default");
        $participant->save();
        $role = Role::where('name','=','collaborateur')->first();
        $participant->attachRole($role->id);
        if($participant->save()) {
            return ["status" => "success", "message" => 'Les informations ont été sauvegardées avec succès.'];
        } else {
            return ["status" => "warning", "message" => 'Une erreur est survenue, réessayez plus tard.'];
        }

    }

    public function edit($id){
        ob_start();
        $participant = Participant::find($id);
        echo view('participants.edit', ['p'=> $participant]);
        $content = ob_get_clean();
        return ['title' => 'Modifier un participant', 'content' => $content];
    }

    public function destroy(Request $request, $id){
        $participant = Participant::find($id);
        $participant->delete();
        return redirect('participants');
    }

    public function espaceCollaborateurs(){
        $participant_id = \Auth::user()->id;
        $sessions = \DB::table('sessions')
            ->join('participant_session', 'participant_session.session_id', '=', 'sessions.id')
            ->join('cours', 'cours.id', '=', 'sessions.cour_id')
            ->select('sessions.*','cours.*')
            ->where('participant_session.user_id', '=', $participant_id)
            ->paginate(10);
        //dd($sessions);
        return view('participants.espaceCollaborateurs', compact('sessions'));
    }
    public function searchCours(Request $request){
        $cours = $request->cours;
        $participant_id = \Auth::user()->id;
        $sessions = \DB::table('sessions')
            ->join('participant_session', 'participant_session.session_id', '=', 'sessions.id')
            ->join('cours', 'cours.id', '=', 'sessions.cour_id')
            ->select('sessions.*','cours.*')
            ->where('participant_session.user_id', '=', $participant_id)
            ->where('cours.titre', 'like', $cours)
            ->paginate(10);
        //dd($sessions);

        return view('participants.espaceCollaborateurs', compact('sessions', 'cours'));
    }

    public function detailsSession($id){
        $session = Session::find($id);
        return view('participants.detailsSession');
    }

    
}
