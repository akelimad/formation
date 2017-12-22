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

        foreach ($request->budgets as $b) {
            $budget = new Budget();
            $budget->session_id=$request->input('session');
            $budget->budget = $b['budget'];
            $budget->prevu  = $b['prevu'];
            $budget->realise= $b['realise'];
            $budget->ajustement= $b['ajustement'];

            $budget->save();
        }
        return redirect('budgets');

    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){
        
    }
}
