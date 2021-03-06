<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Cour;
use App\User;
use App\Http\Requests;
use Excel;
use DateTime;
use Intervention\Image\Facades\Image as Image;

class CourController extends Controller
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
        $cours = Cour::orderBy('id', 'desc')->paginate($per_page);
        return view('cours.index', [
            'results'=>$cours,
            'selected'  =>$selected,
        ]);
    }

    public function create(){
        ob_start();
        $users = User::with('roles')
        ->whereHas('roles', function ($query) {$query->where('name', '!=', 'collaborateur');})
        ->get();
        echo view('cours.create', ['users' => $users]);
        $content = ob_get_clean();
        return ['title' => 'Ajouter un cours', 'content' => $content];
    }

    public function store(Request $request){
        $id = $request->input('id', false);
        $rules = [
            'titre'            => 'required|unique:cours',
            'coordinateur'     => 'required',
            'devise'           => 'required',
            'prix'             => 'required',
            'duree'            => 'required',
            'photo'            => 'max:500',
            'support'            => 'max:2000',
        ];
        if($id) {
            $rules['titre']='required|unique:cours,titre,'.$id;
            $cour = Cour::find($id);
        } else {
            $cour = new Cour();
        }

        $validator = \Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return ["status" => "danger", "message" => $validator->errors()->all()];
        }
        
        $cour->titre=$request->input('titre');
        $cour->description=trim($request->input('description'));
        $cour->devise=$request->input('devise');
        $cour->prix=$request->input('prix');
        $cour->duree=$request->input('duree');
        if($file = $request->hasFile('photo')) {
            $file = $request->file('photo') ;
            
            $fileName = time()."_".$file->getClientOriginalName();
            $destinationPath = public_path('/coursPhotos') ;

            $file->move($destinationPath,$fileName);
            $cour->photo = $fileName ;
        }
        if($file = $request->hasFile('support')) {
            $file = $request->file('support') ;
            
            $fileName = time()."_".$file->getClientOriginalName();
            $destinationPath = public_path('/coursSupport') ;

            $file->move($destinationPath,$fileName);
            $cour->support = $fileName ;
        }
        $cour->user_id=$request->input('coordinateur');
        $cour->save();
        if($cour->save()) {
            return ["status" => "success", "message" => 'Les informations ont été sauvegardées avec succès.'];
        } else {
            return ["status" => "warning", "message" => 'Une erreur est survenue, réessayez plus tard.'];
        }
    }

    public function show($id){
        ob_start();
        $cour = \DB::table('cours')
            ->join('users', 'users.id', '=', 'cours.user_id')
            ->select('cours.*', 'users.name as coordinateur')
            ->where('cours.id','=', $id)
            ->first();
        echo view('cours.show', ['c' => $cour]);
        $content = ob_get_clean();
        return ['title' => 'Détails du cours', 'content' => $content];
    }

    public function edit($id){
        ob_start();
        $users = User::all();
        $cour = Cour::find($id);
        echo view('cours.edit', ['users' => $users, 'c' => $cour]);
        $content = ob_get_clean();
        return ['title' => 'Modifier un cours', 'content' => $content];
    }

    // public function update(Request $request, $id){
    //     $this->validate($request, [
    //         'titre'            => 'required',
    //         'coordinateur'     => 'required',
    //         'devise'          => 'required',
    //         'prix'          => 'required',
    //         'duree'          => 'required',
    //     ]);

    //     $cour = Cour::find($id);
    //     $cour->titre=$request->titre;
    //     $cour->description=$request->description;
    //     $cour->devise=$request->devise;
    //     $cour->prix=$request->prix;
    //     $cour->duree=$request->duree;
    //     $cour->user_id=$request->coordinateur;
    //     $cour->save();
    //     return redirect('cours');
    // }

    public function destroy(Request $request, $id){
        $cour = Cour::find($id);
        $cour->delete();
        $filename = public_path().'/coursPhotos/'.$cour->photo;
        \File::delete($filename);
        $filename1 = public_path().'/coursSupport/'.$cour->support;
        \File::delete($filename1);
        return redirect('cours');
    }

    public function export(){
 
        $cours = \DB::table('cours as c')
        ->join('users as u', 'u.id', '=', 'c.user_id')
        ->selectRaw('c.id as ID, titre as Titre, description as Description, devise as Devise, prix as Budget, duree as Durée, u.name as Coordinateur, DATE_FORMAT(c.created_at, "%d/%m/%Y %H:%i") as "Date de création" ')
        ->get();
        //dd($cours);
        $data = array();
        foreach ($cours as $cour) {
            $data[] = (array)$cour;
        }
        Excel::create('liste-des-cours', function($excel) use($data) {
            $excel->sheet('cours', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('xls');

        return redirect('cours');
    }

    public function usersCours(Request $request){
        $user = User::find($request->user);
        $users = User::with('roles')->whereHas('roles', function ($query) {
            $query->where('name', '!=', 'collaborateur');
        })->get();
        $selected= $request->user;
        if($request->user){
            $user_cours = $user->cours()->paginate(15);
        }
        return view('cours.gestion', compact('users', 'selected','user_cours'));
    }

}
