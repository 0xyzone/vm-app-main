<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Order;
use App\Models\Tables;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Main view Order
    public function view()
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        return view('orders.index');
    }

    // Show Add orders form
    public function show()
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        return view('orders.add', [
            'tables' => Tables::all(),
            'customers' => Customer::all(),
            'items' => Items::paginate(4)
        ]);
    }
    // Store order
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'table' => ['required'],
            'customer' => ['required'],
            'item' => ['required'],
        ]);

        // Create order
        $order = Order::create($formFields);

        return redirect('/orders')->with('success', 'Order added successfully.');
    }
    
}
