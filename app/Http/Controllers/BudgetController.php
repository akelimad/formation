<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Budget;
use App\Session;
use App\Http\Requests;

class BudgetController extends Controller
{
    public function index(){
        $budgets = Budget::all();
        return view('budgets.index', ['budgets'=>$budgets]);
    }

    public function create(){
        $sessions = Session::all();
        return view('budgets.create', ['sessions'=> $sessions]);
    }

    public function store(Request $request){
        //dd($request->input('budgets["budget"]'));
        if(empty($request->input('budget')[0]) && 
            empty($request->input('prevu')[0]) && 
            empty($request->input('realise')[0]) && 
            empty($request->input('ajustement')[0]) ){
            $budget = new Budget();
            $budget->nom=$request->input('nom');
            $budget->session_id=$request->input('session');
            $budget->montant=$request->input('montant');
            $budget->budget = null;
            $budget->prevu  = null;
            $budget->realise= null;
            $budget->ajustement= null;
            $budget->save();
            return redirect('budgets');
        }else{
            foreach ($request->input('budgets') as $budget) {
                dd($budget);
                $budget = new Budget();
                $budget->nom = $request->input('nom');
                $budget->session_id = $request->input('session');
                $budget->montant=$request->input('montant');
                $budget->budget =$budget;
                $budget->save();
            }
            return redirect('budgets');
        }


    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
