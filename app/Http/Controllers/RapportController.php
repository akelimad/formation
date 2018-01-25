<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Budget;
use App\Http\Requests;
use Carbon\Carbon;

class RapportController extends Controller
{
    public function getMonthFR($month){
        switch($month){
            case 'January'  : return 'Jan'; break;
            case 'February' : return 'Fév'; break;
            case 'March'    : return 'Mar'; break;
            case 'April'    : return 'Avr'; break;
            case 'May'      : return 'Mai'; break;
            case 'June'     : return 'Jui'; break;
            case 'July'     : return 'Jui'; break;
            case 'August'   : return 'Aoû'; break;
            case 'September' : return 'Sep'; break;
            case 'October'  : return 'Oct'; break;
            case 'November' : return 'Nov'; break;
            case 'December' : return 'Dec'; break;
        }
    }

    public function standard(Request $request)
    {
        for ($m=1; $m<=12; $m++) {
            $months[]=$this->getMonthFR(date('F', mktime(0,0,0,$m, 1, date('Y'))));
        }

    	$users_cours = \DB::table('cours as c')
            ->rightJoin('users as u', 'u.id', '=', 'c.user_id')
            ->select(array('u.name', \DB::raw("count(c.user_id) as 'total'")))
            ->groupBy('u.id')
            ->get();
        //***********************************************************************
        $budgetsPerMonthResult = Session::with('budgets')
        ->whereRaw('YEAR(start) = ?', [date('Y')])
        ->get()
        ->groupBy(function($date) {
            return $this->getMonthFR(Carbon::parse($date->start)->format('F')); // grouping by months
        });
        $budgetCount = [];
        $budgetsPerMonth = [];
        $somme= 0;
        foreach ($budgetsPerMonthResult as $key => $sessions) {
            foreach ($sessions as $session) {
                foreach ($session->budgets as $budget) {
                    $somme =$somme + $budget->prevu;
                    $budgetCount[$key] = $somme;
                }
                $somme= 0;
            }
        }
        foreach($months as $month){
            if(!empty($budgetCount[$month])){
                $budgetsPerMonth[$month] = $budgetCount[$month];    
            }else{
                $budgetsPerMonth[$month] = 0;    
            }
        }
        //****************************************************************************
        $sessionsPerMonthResult = Session::select('start')
        ->whereRaw('YEAR(start) = ?', [date('Y')])
        ->get()
        ->groupBy(function($date) {
            return $this->getMonthFR(Carbon::parse($date->start)->format('F')); // grouping by months
        });
        $sessionCount = [];
        $sessionsPerMonth = [];
        foreach ($sessionsPerMonthResult as $key => $value) {
            $sessionCount[$key] = count($value);
        }
        foreach($months as $month){
            if(!empty($sessionCount[$month])){
                $sessionsPerMonth[$month] = $sessionCount[$month];    
            }else{
                $sessionsPerMonth[$month] = 0;    
            }
        }

        return view('rapports.standard', [
        	'users_cours' => $users_cours,
            'budgetsPerMonth' => $budgetsPerMonth,
            'sessionsPerMonth' => $sessionsPerMonth
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
