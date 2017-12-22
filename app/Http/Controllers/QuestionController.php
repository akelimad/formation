<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Http\Requests;

class QuestionController extends Controller
{
    public function index(){
        return view('questionnaires.index');
    }

    public function questionnaire($id){
        $q = Question::where('evaluation_id', $id)->get();
        return view('questionnaires.index',['questions' => $q]);
    }

    public function create(){
        
    }

    public function store(Request $request){
        //dd($request->all());
        foreach ($request->questions as $q) {
            $question = new Question();
            $question->evaluation_id=$request->evaluation;
            $question->titre=$q;
            $question->save();
        }
        return redirect('evaluations');
    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
