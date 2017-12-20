<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Session;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participants = \DB::table('session_participants')
            ->join('sessions', 'sessions.id', '=', 'session_participants.session_id')
            ->join('participants', 'participants.id', '=', 'session_participants.participant_id')
            ->select('participants.*', 'sessions.nom as session')
            ->get();
        
        return view('welcome', [
            'participants'=> $participants,
            'sessions'=> $participants,
        ]);
    }
}
