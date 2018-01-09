<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Budget;
use App\Session;
use App\Http\Requests;

class BudgetController extends Controller
{
    
    public function index(){
        $sessions = Session::with('budgets')->get();

        // $sessions = Session::leftJoin('budgets', 'sessions.id', '=', 'budgets.session_id')
        //  ->select(array('sessions.*', 'budgets.*'), \DB::raw('count(budgets.session_id) AS balance'))
        //  ->groupBy('session_id')
        //  ->having('balance', '>', 0)
        //  ->get();

        //dd($sessions);
        return view('budgets.index', ['sessions'=>$sessions]);
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

    public function edit($id){
        $session = Session::find($id);
        $sess_budgets = $session->budgets;
        $first_budget = $session->budgets->first();
        return view('budgets.edit', compact('sess_budgets', 'session','first_budget'));
    }

    public function update(Request $request, $id){
        $s = Session::find($id);
        foreach ($s->budgets as $b) {
            $b->delete();
        }
        //dd($request->budgets);
        foreach ($request->budgets as $budget) {
            //dd($budget['budget']);
            $bud = new Budget();
            $bud->session_id=$request->session;
            $bud->budget = $budget['budget'];
            $bud->prevu  = $budget['prevu'];
            $bud->realise= $budget['realise'];
            $bud->ajustement= $budget['ajustement'];
            $bud->save();
        }
        return redirect('budgets');
    }

    public function destroy($id){
        $s = Session::find($id);
        foreach ($s->budgets as $b) {
            $b->delete();
        }
        return redirect('budgets');
    }
}
