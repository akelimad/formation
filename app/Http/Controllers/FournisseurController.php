<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fournisseur;
use App\Http\Requests;

class FournisseurController extends Controller
{
    public function index(){
        $fournisseurs = Fournisseur::all();
        return view('fournisseurs.index', ['fournisseurs'=>$fournisseurs]);
    }

    public function create(){
        return view('fournisseurs.create');
    }

    public function store(Request $request){
        $fournisseurs = new Fournisseur();
        $fournisseurs->nom=$request->input('nom');
        $fournisseurs->code=$request->input('code');
        $fournisseurs->type=$request->input('type');
        $fournisseurs->specialite=$request->input('specialite');
        $fournisseurs->tel=$request->input('tel');
        $fournisseurs->email=$request->input('email');
        $fournisseurs->fax=$request->input('fax');
        $fournisseurs->personne_contacter=$request->input('personne_contacter');
        $fournisseurs->commentaire=$request->input('commentaire');
        $fournisseurs->save();
        return redirect('fournisseurs');

    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
