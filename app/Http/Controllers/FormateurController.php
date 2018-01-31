<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formateur;
use App\Http\Requests;
use Illuminate\Http\UploadedFile;

class FormateurController extends Controller
{

    public function index(){
        $Formateurs = Formateur::orderBy('id','desc')->paginate(10);
        return view('formateurs.index', ['formateurs'=>$Formateurs]);
    }

    public function create(){
        ob_start();
        echo view('formateurs.create');
        $content = ob_get_clean();
        return ['title' => 'Ajouter un formateur', 'content' => $content];
    }

    public function store(Request $request){
        $id = $request->input('id', false);
        $rules = [
            'nom'            => 'required|regex:/^[a-zA-Z ]+$/',
            'type'           => 'required',
            'email'          => 'required|email|unique:formateurs',
            'tel'            => 'required|regex:/(06)[0-9]{8}/',
            'qualification'  => 'required',
            'expertise'      => 'required',
            'cv'             => 'max:500',
        ];
        if($id) {
            $rules['email'] = 'required|email|unique:formateurs,email,'.$id;
            $formateur = Formateur::find($id);
        } else {
            $formateur = new Formateur();
        }

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return ["status" => "danger", "message" => $validator->errors()->all()];
        }

        $formateur->nom=$request->input('nom');
        $formateur->type=$request->input('type');
        $formateur->email=$request->input('email');
        $formateur->tel=$request->input('tel');
        $formateur->qualification=$request->input('qualification');
        if($file = $request->hasFile('cv')) {
            
            $file = $request->file('cv') ;
            
            $fileName = time()."_".$file->getClientOriginalName() ;
            $destinationPath = public_path('/cvs') ;

            $file->move($destinationPath,$fileName);
            $formateur->cv = $fileName ;
        }
        $formateur->expertise=$request->input('expertise');
        $formateur->autres=$request->input('autres');
        $formateur->rating=$request->input('rating')*20;
        $formateur->save();
        if($formateur->save()) {
            return ["status" => "success", "message" => 'Les informations ont été sauvegardées avec succès.'];
        } else {
            return ["status" => "warning", "message" => 'Une erreur est survenue, réessayez plus tard.'];
        }

    }

    public function show($id){
        ob_start();
        $formateur =  Formateur::find($id);
        echo view('formateurs.show', ['f' => $formateur]);
        $content = ob_get_clean();
        return ['title' => 'Détails du formateur', 'content' => $content];
    }

    public function edit($id){
        ob_start();
        $f = Formateur::find($id);
        echo view('formateurs.edit', ['f' => $f]);
        $content = ob_get_clean();
        return ['title' => 'Modifier un formateur', 'content' => $content];
    }

    // public function update(Request $request ,$id){
    //     $this->validate($request, [
    //         'nom'            => 'required',
    //         'type'           => 'required',
    //         'email'          => 'required',
    //         'tel'            => 'required',
    //         'qualification'  => 'required',
    //         'expertise'      => 'required',
    //         'cv'             => 'max:500',
    //     ]);
        
    //     $Formateurs = Formateur::find($id);
    //     $Formateurs->nom=$request->input('nom');
    //     $Formateurs->type=$request->input('type');
    //     $Formateurs->email=$request->input('email');
    //     $Formateurs->tel=$request->input('tel');
    //     $Formateurs->qualification=$request->input('qualification');
    //     if($file = $request->hasFile('cv')) {
            
    //         $file = $request->file('cv') ;
            
    //         $fileName = time()."_".$file->getClientOriginalName() ;
    //         $destinationPath = public_path('/cvs') ;

    //         $file->move($destinationPath,$fileName);
    //         $Formateurs->cv = $fileName ;
    //     }
    //     $Formateurs->expertise=$request->input('expertise');
    //     $Formateurs->autres=$request->input('autres');
    //     $Formateurs->rating=$request->input('rating')*20;
    //     $Formateurs->save();
    //     return redirect('formateurs');
    // }

    public function destroy($id){
        $formateur = Formateur::find($id);
        $formateur->delete();
        return redirect('formateurs');
    }

    public function gestion(Request $request){
        $formateur = Formateur::find($request->formateur);
        $selected= $request->formateur;
        $formateurs = Formateur::all();
        if($request->formateur) $sessions_formateur = $formateur->sessions;
        return view('formateurs.gestion', compact('formateurs', 'selected','sessions_formateur'));
    }
}
