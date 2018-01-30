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
        ob_start();
        $code= substr(str_shuffle(md5(rand(0,100000))), 0, 8);
        echo view('prestataires.create', compact('code'));
        $content = ob_get_clean();
        return ['title' => 'Ajouter un prestataire', 'content' => $content];
    }

    public function store(Request $request){
        $id = $request->input('id', false);
        $rules = [
            'nom'            => 'required|unique:fournisseurs|alpha',
            'type'           => 'required',
            'specialite'      => 'required',
            'tel'             => 'required|regex:/(06)[0-9]{8}/',
            'fax'               => 'required|regex:/(05)[0-9]{8}/',
            'email'              => 'required',
            'personne_contacter' => 'required|alpha',
        ];
        if($id) {
            $rules['nom'] = 'required|alpha';
            $prestataire = Fournisseur::find($id);
        } else {
            $prestataire = new Fournisseur();
        }

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return ["status" => "danger", "message" => $validator->errors()->all()];
        }

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

        if($prestataire->save()) {
            return ["status" => "success", "message" => 'Les informations ont été sauvegardées avec succès.'];
        } else {
            return ["status" => "warning", "message" => 'Une erreur est survenue, réessayez plus tard.'];
        }

    }

    public function edit($id){
        ob_start();
        $p = Fournisseur::find($id);
        echo view('prestataires.edit', ['p' => $p]);
        $content = ob_get_clean();
        return ['title' => 'Editer les infos du prestataire', 'content' => $content];
    }

    public function show($id){
        ob_start();
        $prestataire =  Fournisseur::find($id);
        echo view('prestataires.show', compact('prestataire'));
        $content = ob_get_clean();
        return ['title' => 'Détails du prestataire', 'content' => $content];
    }

    // public function update(Request $request, $id){
    //     $validator = \Validator::make($request->all(), [
    //         'nom'            => 'required',
    //         'type'          => 'required',
    //         'specialite'      => 'required',
    //         'tel'            => 'required',
    //         'fax'               => 'required',
    //         'email'              => 'required',
    //         'personne_contacter' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return ["status" => "danger", "message" => $validator->errors()->all()];
    //     }

    //     $prestataire = Fournisseur::find($id);
    //     $prestataire->nom=$request->input('nom');
    //     $prestataire->type=$request->input('type');
    //     $prestataire->specialite=$request->input('specialite');
    //     $prestataire->tel=$request->input('tel');
    //     $prestataire->fax=$request->input('fax');
    //     $prestataire->email=$request->input('email');
    //     $prestataire->personne_contacter=$request->input('personne_contacter');
    //     $prestataire->type_entreprise=$request->input('type_entreprise');
    //     $prestataire->qualification=$request->input('qualification');
    //     $prestataire->commentaire=$request->input('commentaire');
    //     $prestataire->save();

    //     if($prestataire->save()) {
    //         return ["status" => "success", "message" => 'Les informations ont été modifiées avec succès.'];
    //     } else {
    //         return ["status" => "warning", "message" => 'Une erreur est survenue, réessayez plus tard.'];
    //     }
        
    // }

    public function delete($id){
        $prestataire =  Fournisseur::find($id);
        if($prestataire->delete()) {
            return ['title' => '<i class="fa fa-check-circle"></i>&nbsp;Le prestataire a été bien supprimé.'];
        } else {
            return ['title' => '<i class="fa fa-exclamation-triangle"></i>&nbsp;Une erreur est survenue, il se peut que l\'objet a une relation avec d\'autres objets'];
        }
    }
}
