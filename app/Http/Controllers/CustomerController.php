<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // Main view Customers
    public function view(){
        if (Auth::guest()){
            return redirect('login');
        }
        return view('customers.index', [
            'customers' => Customer::paginate(5)
        ]);
    }

    // Add Customers - View Form
    public function add(){
        if (Auth::guest()){
            return redirect('login');
        }
        return view('customers.add');
    }
}
