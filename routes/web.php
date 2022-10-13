<?php

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
    return view('main');
});

//Show register form
Route::get('/register', [UserController::class, 'create']);

//Log user out
Route::post('/logout', [UserController::class, 'logout' ]);

//show login form
Route::get('/login', [UserController::class, 'login']);


// Store user
Route::post('/users', [UserController::class, 'store']);
