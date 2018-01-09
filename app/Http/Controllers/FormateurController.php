<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formateur;
use App\Http\Requests;
use Illuminate\Http\UploadedFile;

class FormateurController extends Controller
{

    public function index(){
        $Formateurs = Formateur::orderBy('id','DESC')->get();
        return view('formateurs.index', ['formateurs'=>$Formateurs]);
    }

    public function create(){
        return view('formateurs.create');
    }

    public function store(Request $request){
        //dd($request->all());
        $Formateurs = new Formateur();
        $Formateurs->nom=$request->input('nom');
        $Formateurs->type=$request->input('type');
        $Formateurs->email=$request->input('email');
        $Formateurs->tel=$request->input('tel');
        $Formateurs->qualification=$request->input('qualification');
        if($file = $request->hasFile('cv')) {
            
            $file = $request->file('cv') ;
            
            $fileName = time()."_".$file->getClientOriginalName() ;
            $destinationPath = public_path('/cvs') ;

            $file->move($destinationPath,$fileName);
            $Formateurs->cv = $fileName ;
        }
        $Formateurs->expertise=$request->input('expertise');
        $Formateurs->autres=$request->input('autres');
        $Formateurs->rating=$request->input('rating')*20;
        $Formateurs->save();
        return redirect('sessions');

    }

    public function edit($id){
        $f = Formateur::find($id);
        return view('formateurs.edit', ['f' => $f]);
    }

    public function update(Request $request ,$id){
        $Formateurs = Formateur::find($id);
        $Formateurs->nom=$request->input('nom');
        $Formateurs->type=$request->input('type');
        $Formateurs->email=$request->input('email');
        $Formateurs->tel=$request->input('tel');
        $Formateurs->qualification=$request->input('qualification');
        if($file = $request->hasFile('cv')) {
            
            $file = $request->file('cv') ;
            
            $fileName = time()."_".$file->getClientOriginalName() ;
            $destinationPath = public_path('/cvs') ;

            $file->move($destinationPath,$fileName);
            $Formateurs->cv = $fileName ;
        }
        $Formateurs->expertise=$request->input('expertise');
        $Formateurs->autres=$request->input('autres');
        $Formateurs->rating=$request->input('rating')*20;
        $Formateurs->save();
        return redirect('formateurs');
    }

    public function destroy($id){
        $formateur = Formateur::find($id);
        $formateur->delete();
        return redirect('formateurs');
    }

    public function gestion(Request $request){
        dd($request->all());
        $formateur = Formateur::find($request->formateur);
        $selected= $request->formateur;
        $formateurs = Formateur::all();
        if($request->formateur) $sessions_formateur = $formateur->sessions;
        return view('formateurs.gestion', compact('formateurs', 'selected','sessions_formateur'));
    }
}
