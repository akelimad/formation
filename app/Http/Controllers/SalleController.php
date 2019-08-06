<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salle;
use App\Session;
use App\Http\Requests;
use Carbon\Carbon; 

class SalleController extends Controller
{
    public function index(Request $request){
        $per_page = $selected = 10;
        if( isset($request->per_page) && $request->per_page != "all" ){
            $per_page = $request->per_page;
            $selected = $per_page;
        }else if(isset($request->per_page) && $request->per_page == "all"){
            $per_page = 500;
            $selected = "all";
        }
        $salles = Salle::orderBy('id', 'desc')->paginate($per_page);
        return view('salles.index', [
            'results'=>$salles,
            'selected'  =>$selected,
        ]);
    }

    public function create(){
        ob_start();
        echo view('salles.create');
        $content = ob_get_clean();
        return ['title' => 'Ajouter une salle', 'content' => $content];
    }

    public function store(Request $request){
        $id = $request->input('id', false);
        $rules = [
            'numero'            => 'required|unique:salles',
            'capacite'          => 'required',
            'photo'              => 'max:500',
            'equipements'        => 'required',
        ];
        if($id) {
            $rules['numero']='required|unique:salles,numero,'.$id;
            $salle = Salle::find($id);
        } else {
            $salle = new Salle();
        }
        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return ["status" => "danger", "message" => $validator->errors()->all()];
        }

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
        if($salle->save()) {
            return ["status" => "success", "message" => 'Les informations ont été sauvegardées avec succès.'];
        } else {
            return ["status" => "warning", "message" => 'Une erreur est survenue, réessayez plus tard.'];
        }

    }

    public function show($id){
        ob_start();
        $salle =  Salle::find($id);
        echo view('salles.show', ['s' => $salle]);
        $content = ob_get_clean();
        return ['title' => 'Détails de la salle', 'content' => $content];
    }

    public function edit($id){
        ob_start();
        $salle = Salle::find($id);
        echo view('salles.edit', ['s' => $salle]);
        $content = ob_get_clean();
        return ['title' => 'Modifier une salle', 'content' => $content];
    }

    // public function update(Request $request, $id){
    //     $this->validate($request, [
    //         'numero'            => 'required',
    //         'capacite'          => 'required',
    //         'photo'              => 'max:2000',
    //         'equipements'        => 'required',
    //     ]);

    //     $salle = Salle::find($id);
    //     $salle->numero=$request->input('numero');
    //     $salle->capacite=$request->input('capacite');
    //     $salle->equipements=$request->input('equipements');
    //     if($file = $request->hasFile('photo')) {
    //         $file = $request->file('photo') ;
            
    //         $fileName = time()."_".$file->getClientOriginalName() ;
    //         $destinationPath = public_path('/sallePhotos') ;

    //         $file->move($destinationPath,$fileName);
    //         $salle->photo = $fileName ;
    //     }
    //     $salle->disposition= $request->input('disposition');
    //     $salle->save();
    //     return redirect('salles');
    // }

    public function destroy($id){
        $salle = Salle::find($id);
        $salle->delete();
        $photo = $salle->photo;
        $filename = public_path().'/sallePhotos/'.$photo;
        \File::delete($filename);
        return redirect('salles');
    }

    public function gestion(Request $request){
        $now = Carbon::now()->format('Y-m-d');
        $selected= $request->salle;
        $salles = Salle::select('id', 'numero')->get();
        if($request->salle) {
            $salle = Salle::find($request->salle);
            $occupations = Session::with('salle')
                ->select('id', 'nom','start', 'end')
                ->where('salle_id', '=', $salle->id)->where(\DB::raw("(DATE_FORMAT(start,'%Y-%m-%d'))"),">=", $now)
                ->get();
            //dd($occupations); 
            // foreach ($occupations as $occupation) {
            //     dd($occupation->nom);
            // }
        }
        return view('salles.gestion', compact('salles', 'selected','occupations'));
    }
}
