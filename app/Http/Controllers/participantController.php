<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;
use App\Http\Requests;

class ParticipantController extends Controller
{
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
                'email'            => 'required',
            ];
            $validator = \Validator::make($request->all(), $rules);
            $cour = Participant::find($id);
        } else {
            $rules = [
                'nom'            => 'required|unique',
                'email'            => 'required|unique',
            ];
            $validator = \Validator::make($request->all(), $rules);
            $cour = new Participant();
        }
        if ($validator->fails()) {
            return ["status" => "danger", "message" => $validator->errors()->all()];
        }
        
        $participant->nom=$request->input('nom');
        $participant->email=$request->input('email');
        $participant->save();
        if($cour->save()) {
            return ["status" => "success", "message" => 'Les informations ont été sauvegardées avec succès.'];
        } else {
            return ["status" => "warning", "message" => 'Une erreur est survenue, réessayez plus tard.'];
        }

    }

    public function edit(){
        ob_start();
        echo view('participants.edit');
        $content = ob_get_clean();
        return ['title' => 'Modifier un participant', 'content' => $content];
    }

    public function destroy(Request $request, $id){
        $cour = Participant::find($id);
        $cour->delete();
        return redirect('participants');
    }

    
}
