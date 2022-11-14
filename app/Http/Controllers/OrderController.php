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
    public function store(Request $request, Tables $tab)
    {
        $formFields = $request->validate([
            'table' => ['required'],
        ]);
        $formFields['table'] = implode(',',$formFields['table']);
        // Create order
        Order::create($formFields);
        
        $tables = explode(',',$formFields['table']);
        foreach($tables as $table){
            $avail = Tables::where('id', $table);
            $avail->update(['availability' => 'Occupied']);
        }
        $order_no = Order::latest()->first();
        return redirect('/orders/'.$order_no['id'].'/additems')->with('success', 'Order added successfully.');
    }

    // Add Items page
    public function additems(Order $order_no){
        if(Auth::guest()){
            return redirect('/login');
        } else {
            return view('orders.add-items', [
                'order_no' => $order_no,
                'items' => Items::paginate(8),
            ]);
        };
    }
    
}
