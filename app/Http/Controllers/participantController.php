<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Participant;
use App\Http\Requests;

class participantController extends Controller
{
    public function index(){
        $participants = Participant::all();
        
        return view('participants.index', ['participants'=>$participants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function participantsNames(Request $request){

        $search = $request->participants;
        $term = Input::get('participants');
        $participants= array();
        $queries = \DB::table('participants')->select('id', 'nom')->where('participants.nom','LIKE','%'.$term.'%')->get();
        foreach ($queries as $query)
            {
                $results[] = [ 'id' => $query->id, 'nom' => $query->nom ];
            }
        //return Response::json($results);
        return response()->json($results);
    }

    public function create(){
        return view('participants.create');
    }

    public function store(Request $request){
        $participant = new Participant();
        $participant->nom=$request->input('nom');
        $participant->email=$request->input('email');
        $participant->save();
        return redirect('sessions');

    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
