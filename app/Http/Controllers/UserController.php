<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Logout user
    public function logout(){
        return redirect('/login');
    }

    //show login form
    public function login(){
        return view('users.login');
    }

    //show register
    public function create(){
        return view('users.register');
     }

}
