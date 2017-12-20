<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;

class UserController extends Controller
{

    public function users(){
        $users = User::all();
        return view('users.index', ['users' => $users]);
    }


}
