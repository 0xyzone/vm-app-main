<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Visit;
use App\Models\Tables;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    // Index Page
    public function index()
    {
        if (Auth::guest()) {
            return redirect('/login');
        }
        return view('invoices.index', [
            'title' => 'Invoices',
            'orders' => Order::paginate(5),
            'tables' => Tables::all()
        ]);
    }
    public function show(Order $order)
    {
        if (Auth::guest()) {
            return redirect('/login');
        } else {
            $title = 'Invoices #' . $order->id;
            $tables = Tables::all();
            $customers = Customer::all();
            return view('invoices.single', compact('order', 'tables', 'customers', 'title'));
        };
    }

    // Update Customer in Invoice
    public function customerUpdate(Request $request, Order $order)
    {
        $formFields = $request->validate([
            'customer' => 'required'
        ]);
        $formFields['customer_id'] = $request->customer;
        Visit::create($formFields);
        $order->update(['customer' => $request->customer]);
        return redirect('/invoices/' . $order->id)->with('success', 'Customer assigned successfully.');
    }

    // Update Discount in Invoice
    public function discountUpdate(Request $request, Order $order)
    {
        $request->validate(
            [
                'discount' => 'required'
            ]
        );
        $order->update(['discount' => $request->discount]);

        return redirect('/invoices/' . $order->id)->with('success', 'Discount assigned successfully.');
    }
}
