<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    // Main view Customers
    public function view()
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        return view('customers.index', [
            'customers' => Customer::paginate(3),
            'visits' => Visit::all()
        ]);
    }

    // Add Customers - View Form
    public function add()
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        return view('customers.add');
    }

    // Store Customer
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('customers', 'email')],
            'phone' => ['required', 'max:10', 'min:10', Rule::unique('customers', 'phone')],
            'city' => ['required'],
            'street' => ['required'],
            'country' => ['required'],
            'dob' => ['required'],
            'marriage' => ['required'],
            'marriagedate' => [''],
            'gender' => ['required'],
        ]);

        // Create Customer
        Customer::create($formFields);

        $visits['customer_id'] = Customer::latest()->first()->id;

        Visit::create($visits);

        return redirect('/customers')->with('success', 'Customer added successfully.');
    }

    // Edit Form - Customer
    public function edit(customer $customer)
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        return view('customers.edit', [
            'customer' => $customer,
        ]);
    }

    // Update Customer
    public function update(Request $request, customer $customer)
    {
        $formFields = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('customers', 'email')->ignore($customer->id)],
            'phone' => ['required', 'max:10', 'min:10', Rule::unique('customers', 'phone')->ignore($customer->id)],
            'city' => ['required'],
            'street' => ['required'],
            'country' => ['required'],
            'dob' => ['required'],
            'marriage' => ['required'],
            'gender' => ['required'],
            'marriagedate' => ['required'],
            'visit' => ['required'],
        ]);
        $customer->update($formFields);
        return redirect('/customers')->with('success', 'Customer updated successfully.');
    }

    //Delete Customer
    public function delete (customer $customer) {
        $customer->delete();

        return redirect('/customers')->with('success', 'Customer deleted successfully!');
    }

    // View Particular Customer
    public function single ($customer) {
        if(Auth::guest()) {
            return redirect('login');
        } else {
            return view('customers.single', [
                'customer' => Customer::find($customer),
                'visits' => Visit::all()
            ]);
        }
    }
}
