<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Http\Requests;

class RapportController extends Controller
{
    public function standard(Request $request)
    {
    	$users_cours = \DB::table('cours as c')
            ->rightJoin('users as u', 'u.id', '=', 'c.user_id')
            ->select(array('u.name', \DB::raw("count(c.user_id) as 'total'")))
            ->groupBy('u.id')
            ->get();
        return view('rapports.standard', [
        	'users_cours' => $users_cours
        ]);
    }

    public function personnalise(Request $request)
    {
        $sessions = Session::all();
        $session_id = $request->session;
        $sessions_year = \DB::table('sessions')
            ->select(\DB::raw('YEAR(start) year, COUNT(*) countSessions'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();

        if(isset($session_id)){
            $session = Session::find($session_id);
            $session_budgets = $session->budgets;
            //dd(count($session_budgets));
            return view('rapports.personnalise', [
                'session_budgets' => $session_budgets,
                'sessions' => $sessions,
                'selected' => $session_id,
                'sessions_year' => $sessions_year,
            ]);
        }else{
            return view('rapports.personnalise', ['sessions' => $sessions, 'sessions_year' => $sessions_year]);
        }
    }

}
