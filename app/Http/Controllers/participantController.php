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
        return view('participants.create');
    }

    public function store(Request $request){
        $participant = new Participant();
        $participant->nom=$request->input('nom');
        $participant->email=$request->input('email');
        $participant->save();
        return redirect('participants');

    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(Request $request, $id){
        $cour = Participant::find($id);
        $cour->delete();
        return redirect('participants');
    }

    
}
