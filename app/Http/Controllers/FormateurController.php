<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formateur;
use App\Http\Requests;

class FormateurController extends Controller
{
    public function index(){
        $Formateurs = Formateur::all();
        return view('formateurs.index', ['formateurs'=>$Formateurs]);
    }

    public function create(){
        return view('formateurs.create');
    }

    public function store(Request $request){
        $Formateurs = new Formateur();
        $Formateurs->nom=$request->input('nom');
        $Formateurs->type=$request->input('type');
        $Formateurs->email=$request->input('email');
        $Formateurs->tel=$request->input('tel');
        $Formateurs->save();
        // return redirect('formateurs');

    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
