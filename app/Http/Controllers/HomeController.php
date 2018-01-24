<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Session;
use App\Cour;
use Carbon\Carbon; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

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

    public function index()
    {

        $participants = \DB::table('participant_session')
            ->join('sessions', 'sessions.id', '=', 'participant_session.session_id')
            ->join('participants', 'participants.id', '=', 'participant_session.participant_id')
            ->select('participants.*', 'sessions.nom as session', 'sessions.start as start', 'sessions.end as end')
            ->take(10)->get();
        $now = Carbon::now()->format('Y-m-d h:i');
        $sessions = Session::where('start','>', $now)->take(10)->get();

        $countSessions= Session::count();
        $countCours= Cour::count();

        $sommeBudgets = \DB::table('budgets as b')
            ->select(array(
                    \DB::raw("sum(b.prevu) as 'totalPrevu'"), 
                    \DB::raw("sum(b.realise) as 'totalRealise'")
                ))
            ->get();


        $sessionsPerMonthResult = Session::select('start')
        ->whereRaw('YEAR(start) = ?', [date('Y')])
        ->get()
        ->groupBy(function($date) {
            return $this->getMonthFR(Carbon::parse($date->start)->format('F')); // grouping by months
        });
        //dd($sessionsPerMonthResult);;
        $sessionCount = [];
        $sessionsPerMonth = [];

        foreach ($sessionsPerMonthResult as $key => $value) {
            $sessionCount[$key] = count($value);
        }

        for ($m=1; $m<=12; $m++) {
            //$months[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
            $months[]=$this->getMonthFR(date('F', mktime(0,0,0,$m, 1, date('Y'))));
        }
        //dd($months);

        
        //dd($months);

        foreach($months as $month){
            if(!empty($sessionCount[$month])){
                $sessionsPerMonth[$month] = $sessionCount[$month];    
            }else{
                $sessionsPerMonth[$month] = 0;    
            }
        }
        //dd($sessionsPerMonth);
        
        return view('welcome', [
            'participants'=> $participants,
            'sessions'=> $sessions,
            'countSessions'=> $countSessions,
            'countCours'=> $countCours,
            'sommeBudgets'=> $sommeBudgets,
            'sessionsPerMonth'=> $sessionsPerMonth,
        ]);
    }
}
