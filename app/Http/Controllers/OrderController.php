<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Main view Order
    public function view(){
        if (Auth::guest()){
            return redirect('login');
        }
        return view('orders.index');
    }
}
