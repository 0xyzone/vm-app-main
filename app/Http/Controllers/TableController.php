<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{

    public function store(Request $request)
    {
        //Validation
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('tables', 'name')],
            'availability' => ['required'],
            'floor' => ['required'],
            'seats' => ['required'],
        ]);

        //create table
        Tables::create($formFields);

        return redirect('/tables')->with('success', 'Table added sucessfully');
    }

    // Show Add tables form
    public function show()
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        return view('tables.add');
    }

    // Show Main tables view
    public function view()
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        return view('tables.index', [
            'tables' => Tables::paginate(8)
        ]);
    }

    // Show reserve table view
    public function reserve(Tables $table)
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        return view('tables.table', [
            'tables' => $table,
        ]);
    }
    // Reserve a table
    public function reserve_update(Request $request, Tables $table)
    {
        $formFields = $request->validate([
            'availability' => ['required'],
        ]);

        $table->update($formFields);

        return redirect('/tables')->with('success', 'Table updated successfully');
    }
}
