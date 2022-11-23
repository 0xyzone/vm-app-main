<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Main Dashboard View
    public function view()
    {
        if (Auth::guest()) {
            //is a Laravel guest so redirect
            return redirect('login');
        } else {
            return view('dashboard');
        }
    }
}
