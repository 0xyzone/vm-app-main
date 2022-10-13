<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;

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

    // Register a user
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'username' => ['required', Rule::unique('users','username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:8',
            'phone' => ['required', Rule::unique('users', 'phone')],
            'role' => ['required'],
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create user
        $user = User::create($formFields);

        return redirect('/register')->with('message', 'User registered successfully.');

    }

}
