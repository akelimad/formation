<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evaluation;
use App\Session;
use App\Http\Requests;

class EvaluationController extends Controller
{
    public function index(){
        $evaluations = \DB::table('evaluations')
            ->join('sessions', 'sessions.id', '=', 'evaluations.session_id')
            ->select('evaluations.*', 'sessions.nom as session')
            ->get();
        return view('evaluations.index', ['evaluations'=>$evaluations]);
    }

    public function create(){
        $sessions = Session::all();
        return view('evaluations.create', ['sessions'=> $sessions]);
    }

    public function store(Request $request){

        //dd($request->all());
        $cour = new Evaluation();
        $cour->nom=$request->input('nom');
        $cour->type=$request->input('type');
        $cour->session_id=$request->input('session');
        $cour->save();
        return redirect('evaluations');

    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
