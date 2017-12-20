<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cour;
use App\User;
use App\Http\Requests;

class CourController extends Controller
{
    public function index(){
        $cours = Cour::all();
        return view('cours.index', ['cours'=>$cours]);
    }

    public function create(){
        $users = User::all();
        return view('cours.create', ['users' => $users]);
    }

    public function store(Request $request){
        $cour = new Cour();
        $cour->titre=$request->input('titre');
        $cour->description=$request->input('description');
        $cour->devise=$request->input('devise');
        $cour->prix=$request->input('prix');
        $cour->duree=$request->input('duree');
        $cour->user_id=$request->input('coordinateur');
        $cour->save();
        return redirect('cours');

    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
