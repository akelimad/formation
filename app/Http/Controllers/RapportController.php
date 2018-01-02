<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RapportController extends Controller
{
    public function index(){
        return view('rapports.budget_formation');
    }
    public function index1(){
    	$users_cours = \DB::table('cours as c')
            ->rightJoin('users as u', 'u.id', '=', 'c.user_id')
            ->select(array('u.name', \DB::raw("count(c.user_id) as 'total'")))
            ->groupBy('u.id')
            ->get();
        return view('rapports.formation_utilisateurs', [
        	'users_cours' => $users_cours
        ]);
    }

}
