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
    public function index()
    {

        $participants = \DB::table('participant_session')
            ->join('sessions', 'sessions.id', '=', 'participant_session.session_id')
            ->join('participants', 'participants.id', '=', 'participant_session.participant_id')
            ->select('participants.*', 'sessions.nom as session')
            ->take(10)->get();
        $now = Carbon::now()->format('Y-m-d h:i');
        $sessions = Session::where('start','>', $now)->take(10)->get();

        $countSessions= Session::count();
        $countCours= Cour::count();
        
        return view('welcome', [
            'participants'=> $participants,
            'sessions'=> $sessions,
            'countSessions'=> $countSessions,
            'countCours'=> $countCours,
        ]);
    }
}
