<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;
use App\Role;
use App\Session;
use App\User;
use App\Http\Requests;

class ParticipantController extends Controller
{
    public function rand_string( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,$length);
    }

    public function index(){
        $participants = Participant::orderBy('id', 'desc')->paginate(10);
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
        $participant->password= bcrypt($this->rand_string(8));
        $participant->save();
        $participant->attachRole(2);
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
        $sessions = Session::all();
        return view('participants.espaceCollaborateurs', compact('sessions'));
    }

    public function detailsSession($id){
        $session = Session::find($id);
        return view('participants.detailsSession');
    }

    
}
