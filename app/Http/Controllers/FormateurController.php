<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formateur;
use App\Http\Requests;
use Illuminate\Http\UploadedFile;

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
        //dd($request->all());
        $Formateurs = new Formateur();
        $Formateurs->nom=$request->input('nom');
        $Formateurs->type=$request->input('type');
        $Formateurs->email=$request->input('email');
        $Formateurs->tel=$request->input('tel');
        $Formateurs->qualification=$request->input('qualification');
        if($file = $request->hasFile('cv')) {
            
            $file = $request->file('cv') ;
            
            $fileName = $file->getClientOriginalName() ;
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

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
