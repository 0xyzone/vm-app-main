<?php

namespace App\Http\Controllers;

use App\Models\Tables;
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

    // Show Add orders form
    public function show(){
        if (Auth::guest()){
            return redirect('login');
        }
        return view('orders.add', [
            'tables' => Tables::all()
        ]);
    }
}
