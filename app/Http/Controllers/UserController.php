<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    

    // Register a user
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required'],
            'username' => ['required', Rule::unique('users','username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:8',
            'phone' => ['required', 'max:10', Rule::unique('users', 'phone')],
            'role' => ['required'],
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);
        
        // Create user
        $user = User::create($formFields);

        return redirect('/')->with('message', 'User registered successfully.');
    }

    //show register
    public function create(){
        return view('users.register');
     }

    //Logout user
    public function logout(){
        return redirect('/login');
    }

    //show login form
    public function login(){
        return view('users.login');
    }

    //authenticate user
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'username' => ['required'],
            'password' => 'required'
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/')->with('success', 'You are now logged in!');
        }

        return back()->withErrors(['username' => 'Invalid Username'])->onlyInput('username');
    }
}
