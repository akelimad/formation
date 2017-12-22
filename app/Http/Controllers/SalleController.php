<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salle;
use App\Http\Requests;

class SalleController extends Controller
{
    public function index(){
        $salles = Salle::all();
        return view('salles.index', ['salles'=>$salles]);
    }

    public function create(){
        return view('salles.create');
    }

    public function store(Request $request){
        $salle = new Salle();
        $salle->numero=$request->input('numero');
        $salle->capacite=$request->input('capacite');
        $salle->equipements=$request->input('equipements');
        if($file = $request->hasFile('photo')) {
            $file = $request->file('photo') ;
            
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path('/sallePhotos') ;

            $file->move($destinationPath,$fileName);
            $salle->photo = $fileName ;
        }
        $salle->save();
        return redirect('salles');

    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
