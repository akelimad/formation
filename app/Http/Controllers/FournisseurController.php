<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fournisseur;
use App\Http\Requests;

class FournisseurController extends Controller
{
    public function index(){
        $prestataires = Fournisseur::all();
        return view('prestataires.index', ['prestataires'=>$prestataires]);
    }

    public function create(){
        return view('prestataires.create');
    }

    public function store(Request $request){
        $prestataire = new Fournisseur();
        $prestataire->nom=$request->input('nom');
        $prestataire->code=$request->input('code');
        $prestataire->type=$request->input('type');
        $prestataire->specialite=$request->input('specialite');
        $prestataire->tel=$request->input('tel');
        $prestataire->email=$request->input('email');
        $prestataire->fax=$request->input('fax');
        $prestataire->personne_contacter=$request->input('personne_contacter');
        $prestataire->type_entreprise=$request->input('type_entreprise');
        $prestataire->qualification=$request->input('qualification');
        $prestataire->commentaire=$request->input('commentaire');
        $prestataire->save();
        return redirect('prestataires');

    }

    public function edit($id){
        $p = Fournisseur::find($id);
        return view('prestataires.edit', ['p' => $p]);
    }

    public function update(Request $request, $id){
        $prestataire = Fournisseur::find($id);
        $prestataire->nom=$request->input('nom');
        $prestataire->code=$request->input('code');
        $prestataire->type=$request->input('type');
        $prestataire->specialite=$request->input('specialite');
        $prestataire->tel=$request->input('tel');
        $prestataire->email=$request->input('email');
        $prestataire->fax=$request->input('fax');
        $prestataire->personne_contacter=$request->input('personne_contacter');
        $prestataire->type_entreprise=$request->input('type_entreprise');
        $prestataire->qualification=$request->input('qualification');
        $prestataire->commentaire=$request->input('commentaire');
        $prestataire->save();
        return redirect('prestataires');
    }

    public function destroy(){
        
    }
}
