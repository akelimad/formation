<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cour;
use App\Http\Requests;

class CourController extends Controller
{
    public function index(){
        $cours = Cour::all();
        return view('cours.index', ['cours'=>$cours]);
    }

    public function create(){
        return view('cours.create');
    }

    public function store(Request $request){
        $cour = new Cour();
        $cour->titre=$request->input('titre');
        $cour->description=$request->input('description');
        $cour->coordinateur=$request->input('coordinateur');
        $cour->sous_unite=$request->input('sous_unite');
        $cour->version=$request->input('version');
        $cour->sub_version=$request->input('sub_version');
        $cour->devise=$request->input('devise');
        $cour->prix=$request->input('prix');
        $cour->entreprise=$request->input('entreprise');
        $cour->duree=$request->input('duree');
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
