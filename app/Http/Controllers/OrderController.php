<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Order;
use App\Models\Tables;
use App\Models\Customer;
use App\Models\OrderItem;
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
        return view('orders.index', [
            'orders' => Order::paginate(5),
            'tables' => Tables::all()
        ]);
    }

    // Show Add orders form
    public function show()
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        return view('orders.add', [
            'title' => 'Add New Order',
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
    public function additems(Order $order){
        if(Auth::guest()){
            return redirect('/login');
        } else {
            $tables = Tables::all();
            $customers = Customer::all();
            return view('orders.add-items', compact('order', 'tables', 'customers'));
        };
    }

    // Update order payment to paid
    public function paid(Order $id) {
        $id->update(['payment' => 'Paid']);
        return redirect('/orders/'.$id->id .'/additems')->with('success', 'Order status updated to PAID!');
    }

    // Update order status to complete
    public function complete(Order $id) {
        $id->update(['status' => 'Completed']);

        $tables = explode(',', $id->table);
        foreach($tables as $table){
            $update = Tables::where('id', $table);
            $update->update(['availability' => 'Available']);
        }
        return redirect('/orders')->with('success', 'Order status updated to Completed!');
    }
    
    // Show Transfer Table form
    public function transferView(Order $order){
        if (Auth::guest()) {
            return redirect('login');
        }
        $title = "Transfer Tables";
        $items = Items::all();
        $orderItems = OrderItem::with('order')->get();
        $tables = Tables::all();
        return view('tables.transfer', compact('order', 'items', 'orderItems', 'title', 'tables'));
    }
    
    // Show Transfer Table form
    public function mergeView(Order $order){
        if (Auth::guest()) {
            return redirect('login');
        }
        $title = "Merge Tables";
        $items = Items::all();
        $orderItems = OrderItem::with('order')->get();
        $tables = Tables::all();
        return view('tables.merge', compact('order', 'items', 'orderItems', 'title', 'tables'));
    }

    // Update the table transfer
    public function transfer(Request $request, Order $order){

        $request->validate([
            'table' => ['required'],
        ]);
        $tables = explode(",", $order->table);
        
        foreach($tables as $table){
            $update = Tables::where('id', $table);
            $update->update(['availability' => 'Available']);
        }

        $formFields = $request;
        foreach($formFields->table as $table2){
            $update2 = Tables::where('id', $table2);
            $update2->update(['availability' => 'Occupied']);
        }

        $formFields2 = implode(',', $request['table']);
        $order->update(['table' => $formFields2]);

        return redirect('/orders/'. $order->id .'/additems')->with('success', 'Table transfered successfully!');
    }

    // Merge Table
    public function merge(Request $request, Order $order){
        $request->validate([
            'table' => ['required'],
        ]);
        $tables = implode(',', $request->table);
        $mergeTable = $order->table . ','. $tables;
        $order->update(['table' => $mergeTable]);

        foreach($request->table as $req){
            $tables = Tables::where('id', $req);
            $tables->update(['availability' => 'Occupied']);
        }
        return redirect('/orders/'. $order->id .'/additems')->with('success', 'Table merged successfully!');

    }
}
