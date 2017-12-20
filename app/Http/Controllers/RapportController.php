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
        return view('rapports.formation_utilisateurs');
    }
}
