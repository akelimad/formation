<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \
use App\Http\Requests;

class QuestionController extends Controller
{
    public function index(){
        
    }

    public function create(){
        
    }

    public function store(Request $request){
        $fournisseurs = new Fournisseur();
        $fournisseurs->titre=$request->input('titre');
        $fournisseurs->evaluation_id="1";
        $fournisseurs->save();
        return redirect('evaluations');

    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
