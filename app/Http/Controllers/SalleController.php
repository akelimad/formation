<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salle;
use App\Session;
use App\Http\Requests;
use Carbon\Carbon; 

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
        $this->validate($request, [
            'numero'            => 'required|unique:salles',
            'capacite'          => 'required',
            'photo'              => 'max:2000',
            'equipements'        => 'required',
        ]);

        $salle = new Salle();
        $salle->numero=$request->input('numero');
        $salle->capacite=$request->input('capacite');
        $salle->equipements=$request->input('equipements');
        if($file = $request->hasFile('photo')) {
            $file = $request->file('photo') ;
            
            $fileName = time()."_".$file->getClientOriginalName();
            $destinationPath = public_path('/sallePhotos') ;

            $file->move($destinationPath,$fileName);
            $salle->photo = $fileName ;
        }
        $salle->disposition= $request->input('disposition');
        $salle->save();
        return redirect('salles');

    }

    public function show($id){
        $salle =  Salle::find($id);
        return view('salles.show', ['s' => $salle]);
    }

    public function edit($id){
        $salle = Salle::find($id);
        return view('salles.edit', ['s' => $salle]);
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'numero'            => 'required',
            'capacite'          => 'required',
            'photo'              => 'max:2000',
            'equipements'        => 'required',
        ]);

        $salle = Salle::find($id);
        $salle->numero=$request->input('numero');
        $salle->capacite=$request->input('capacite');
        $salle->equipements=$request->input('equipements');
        if($file = $request->hasFile('photo')) {
            $file = $request->file('photo') ;
            
            $fileName = time()."_".$file->getClientOriginalName() ;
            $destinationPath = public_path('/sallePhotos') ;

            $file->move($destinationPath,$fileName);
            $salle->photo = $fileName ;
        }
        $salle->disposition= $request->input('disposition');
        $salle->save();
        return redirect('salles');
    }

    public function destroy($id){
        $salle = Salle::find($id);
        $photo = $salle->photo;
        $filename = public_path().'/sallePhotos/'.$photo;
        \File::delete($filename);
        $salle->delete();
        return redirect('salles');
    }

    public function gestion(Request $request){
        $salle = Salle::find($request->salle);
        $now = Carbon::now()->format('Y-m-d h:i:s');
        $selected= $request->salle;
        $salles = Salle::all();
        if($request->salle) {
            $sessions_salle = Session::where('sessions.start','>=', $now)->where('sessions.salle_id','=', $request->salle)->get();
        }
        return view('salles.gestion', compact('salles', 'selected','sessions_salle'));
    }
}
