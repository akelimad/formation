<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Budget;
use App\Session;
use App\Http\Requests;

class BudgetController extends Controller
{
    
    public function index(){
        $sessions = Session::with('budgets')->paginate(10);

        // $sessions = Session::leftJoin('budgets', 'sessions.id', '=', 'budgets.session_id')
        //  ->select(array('sessions.*', 'budgets.*'), \DB::raw('count(budgets.session_id) AS balance'))
        //  ->groupBy('session_id')
        //  ->having('balance', '>', 0)
        //  ->get();

        //dd($sessions);
        return view('budgets.index', ['sessions'=>$sessions]);
    }

    public function create($sid){
        ob_start();
        $sessions = Session::all();
        echo view('budgets.create', ['sessions'=> $sessions, 'sid' => $sid]);
        $content = ob_get_clean();
        return ['title' => 'Ajouter un budget', 'content' => $content];
    }

    public function store(Request $request){
        $id = $request->input('id', false);
        if($id) {
            $rules = [
                'session'    => 'required',
                'budget'     => 'required',
                'prevu'      => 'required',
                'realise'    => 'required',
            ];
            $validator = \Validator::make($request->all(), $rules);
            $s = Session::find($id);
            foreach ($s->budgets as $b) {
                $b->delete();
            }
        } else {
            $rules = [
                'session'    => 'required',
                'budget'     => 'required',
                'prevu'      => 'required',
                'realise'    => 'required',
            ];
            $validator = \Validator::make($request->all(), $rules);
        }
        if($request->budgets){
            foreach ($request->budgets as $b) {
                $budget = new Budget();
                $budget->session_id=$request->input('session');
                $budget->budget = $b['budget'];
                $budget->prevu  = $b['prevu'];
                $budget->realise= $b['realise'];
                $budget->ajustement= $b['ajustement'];
                $budget->save();
            }
        }
        if($budget->save()) {
            return ["status" => "success", "message" => 'Les informations ont été sauvegardées avec succès.'];
        } else {
            return ["status" => "warning", "message" => 'Une erreur est survenue, réessayez plus tard.'];
        }

    }

    public function show($id){
        ob_start();
        $session = Session::find($id);
        $sess_budgets = $session->budgets;
        echo view('budgets.show', compact('sess_budgets', 'session'));
        $content = ob_get_clean();
        return ['title' => 'Détails du budget', 'content' => $content];
    }

    public function edit($id){
        ob_start();
        $session = Session::find($id);
        $sess_budgets = $session->budgets;
        $first_budget = $session->budgets->first();
        echo view('budgets.edit', compact('sess_budgets', 'session','first_budget'));
        $content = ob_get_clean();
        return ['title' => 'Modifier un budget', 'content' => $content];
    }

    // public function update(Request $request, $id){
    //     $s = Session::find($id);
    //     foreach ($s->budgets as $b) {
    //         $b->delete();
    //     }
    //     //dd($request->budgets);
    //     foreach ($request->budgets as $budget) {
    //         //dd($budget['budget']);
    //         $bud = new Budget();
    //         $bud->session_id=$request->session;
    //         $bud->budget = $budget['budget'];
    //         $bud->prevu  = $budget['prevu'];
    //         $bud->realise= $budget['realise'];
    //         $bud->ajustement= $budget['ajustement'];
    //         $bud->save();
    //     }
    //     return redirect('budgets');
    // }

    public function destroy($id){
        $s = Session::find($id);
        foreach ($s->budgets as $b) {
            $b->delete();
        }
        return redirect('budgets');
    }
}
