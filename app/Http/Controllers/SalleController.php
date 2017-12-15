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
        $salle->capacite=$request->input('cap');
        $salle->equipements=$request->input('equipements');
        $salle->photo=$request->input('photo');
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
