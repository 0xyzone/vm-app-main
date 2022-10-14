<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    if (Auth::guest()) {
        //is a Laravel guest so redirect
        return redirect('login');
       }
    return view('main');
});

//Show register form
Route::get('/register', [UserController::class, 'create']);

//Show User Management form
Route::get('/umgmt', [UserController::class, 'usermanagement']);

// Store user
Route::post('/users', [UserController::class, 'store']);

//show login form
Route::get('/login', [UserController::class, 'login']);

//Log user out
Route::post('/logout', [UserController::class, 'logout' ]);

//log user in
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Dashboard
Route::get('/dashboard', function() {
    if (Auth::guest()) {
        //is a Laravel guest so redirect
        return redirect('login');
       }
    return view('dashboard');
});