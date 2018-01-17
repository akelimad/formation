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
        return view('formateurs.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'nom'            => 'required|unique:formateurs',
            'type'           => 'required',
            'email'          => 'required',
            'tel'            => 'required',
            'qualification'  => 'required',
            'expertise'      => 'required',
            'cv'             => 'max:500',
        ]);

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
        return redirect('formateurs');

    }

    public function show($id){
        $formateur =  Formateur::find($id);
        return view('formateurs.show', ['f' => $formateur]);
    }

    public function edit($id){
        $f = Formateur::find($id);
        return view('formateurs.edit', ['f' => $f]);
    }

    public function update(Request $request ,$id){
        $this->validate($request, [
            'nom'            => 'required',
            'type'           => 'required',
            'email'          => 'required',
            'tel'            => 'required',
            'qualification'  => 'required',
            'expertise'      => 'required',
            'cv'             => 'max:500',
        ]);
        
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
        $formateur = Formateur::find($request->formateur);
        $selected= $request->formateur;
        $formateurs = Formateur::all();
        if($request->formateur) $sessions_formateur = $formateur->sessions;
        return view('formateurs.gestion', compact('formateurs', 'selected','sessions_formateur'));
    }
}
