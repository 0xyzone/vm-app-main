<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    // Register a user
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required'],
            'username' => ['required', Rule::unique('users', 'username')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:8',
            'phone' => ['required', 'max:10', Rule::unique('users', 'phone')],
            'role' => ['required'],
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create user
        $user = User::create($formFields);

        return redirect('/users')->with('success', 'User registered successfully.');
    }

    //show register
    public function create()
    {
        if (Auth::guest()) {
            //is a Laravel guest so redirect
            return redirect('login');
        } else {
            return view('users.register');
        }
    }

    //Logout user
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('success', "You have been successfully logged out!");
    }

    //show login form
    public function login()
    {
        if(Auth::guest()){
        Redirect::setIntendedUrl(url()->previous());
        return view('users.login');
        } else {
            return redirect('/');
        }
    }

    //authenticate user
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'username' => ['required'],
            'password' => 'required'
        ]);

        if (auth()->attempt($formFields)) {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME)->with('success', 'You are now logged in!');
        }

        /*  return back()->withErrors(['username' => 'Invalid Username'])->onlyInput('username'); */

        return back()->with('error', 'Credentials does not match in our database.');
    }

    // User Index
    public function index()
    {
        if(Auth::guest()){
            return redirect('/login');
        }
        return view('users.index', [
            'users' =>  User::paginate(10, ['*'], 'users')
        ]);
    }

    //edit user
    public function edit(user $user)
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        return view('users.edit', [
            'user' =>  $user
        ]);
    }

    //update user
    public function update(Request $request, user $user)
    {
        $formFields = $request->validate([
            'name' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'max:10'],
            'role' => ['required'],
        ]);

        if(isset($request['password'])){
            $formFields['password'] = bcrypt($request['password']);
        }

        // Update user
        $user->update($formFields);

        return redirect('/users')->with('success', 'User updated successfully.');
    }

    // Delete User
    public function destroy(user $user)
    {
        $user->delete();

        return redirect('/users')->with('success', 'User deleted successfully!');
    }
}
