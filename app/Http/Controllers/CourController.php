<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Cour;
use App\User;
use App\Http\Requests;
use Excel;
use DateTime;

class CourController extends Controller
{
    public function index(){
        $cours = Cour::all();
        return view('cours.index', ['cours'=>$cours]);
    }

    public function create(){
        $users = User::all();
        return view('cours.create', ['users' => $users]);
    }

    public function store(Request $request){
        $cour = new Cour();
        $cour->titre=$request->input('titre');
        $cour->description=$request->input('description');
        $cour->devise=$request->input('devise');
        $cour->prix=$request->input('prix');
        $cour->duree=$request->input('duree');
        $cour->user_id=$request->input('coordinateur');
        $cour->save();
        return redirect('cours');

    }

    public function edit($id){
        $users = User::all();
        $cour = Cour::find($id);
        return view('cours.edit', ['c' => $cour, 'users' => $users]);
    }

    public function update(Request $request, $id){
        $cour = Cour::find($id);
        $cour->titre=$request->input('titre');
        $cour->description=$request->input('description');
        $cour->devise=$request->input('devise');
        $cour->prix=$request->input('prix');
        $cour->duree=$request->input('duree');
        $cour->user_id=$request->input('coordinateur');
        $cour->save();
        return redirect('cours');
    }

    public function destroy(){
        
    }

    public function export(){

        $cours = \DB::table('cours as c')
        ->join('users as u', 'u.id', '=', 'c.user_id')
        ->selectRaw('c.id, titre, description, devise, prix, duree, u.name as coordinateur, DATE_FORMAT(c.created_at, "%d/%m/%Y %H:%i") as creation')
        ->get();
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

}
