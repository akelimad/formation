<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fournisseur;
use App\Http\Requests;

class FournisseurController extends Controller
{
    public function index(){
        $prestataires = Fournisseur::OrderBy('id', 'desc')->paginate(10);
        return view('prestataires.index', ['prestataires'=>$prestataires]);
    }

    public function create(){
        $code= substr(str_shuffle(md5(rand(0,100000))), 0, 8);
        return view('prestataires.create', compact('code'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'nom'            => 'required|unique:fournisseurs',
            'code'           => 'required',
            'type'          => 'required',
            'specialite'      => 'required',
            'tel'            => 'required|min:10|max:10',
            'fax'               => 'required|min:10|max:10',
            'email'              => 'required',
            'personne_contacter' => 'required',
        ]);

        $prestataire = new Fournisseur();
        $prestataire->nom=$request->input('nom');
        $prestataire->code=$request->input('code');
        $prestataire->type=$request->input('type');
        $prestataire->specialite=$request->input('specialite');
        $prestataire->tel=$request->input('tel');
        $prestataire->fax=$request->input('fax');
        $prestataire->email=$request->input('email');
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

    public function show($id){
        $prestataire =  Fournisseur::find($id);
        return view('prestataires.show', compact('prestataire'));
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'nom'            => 'required',
            'type'          => 'required',
            'specialite'      => 'required',
            'tel'            => 'required',
            'fax'               => 'required',
            'email'              => 'required',
            'personne_contacter' => 'required',
        ]);

            $prestataire = Fournisseur::find($id);
            $prestataire->nom=$request->input('nom');
            $prestataire->type=$request->input('type');
            $prestataire->specialite=$request->input('specialite');
            $prestataire->tel=$request->input('tel');
            $prestataire->fax=$request->input('fax');
            $prestataire->email=$request->input('email');
            $prestataire->personne_contacter=$request->input('personne_contacter');
            $prestataire->type_entreprise=$request->input('type_entreprise');
            $prestataire->qualification=$request->input('qualification');
            $prestataire->commentaire=$request->input('commentaire');
            $prestataire->save();
            // if($prestataire->save()){
            //     return response()->json(['success' => 'true']);
            // }else{
            //     return response()->json(['success' => 'false']);
            // }
            return redirect('prestataires');
        
    }

    public function destroy($id){
        $prestataire =  Fournisseur::find($id);
        $prestataire->delete();
        return redirect('prestataires');
    }
}
