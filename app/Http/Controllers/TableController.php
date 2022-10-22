<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class TableController extends Controller
{

    public function store(Request $request){
        //Validation
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('tables', 'name')],
            'availability' => ['required'],
            'floor' => ['required'],
        ]);

        //create table
        Tables::create($formFields);

        return redirect('/tables')->with('success', 'Table added sucessfully');
    }

    // Show Add tables form
    public function show(){
        return view('tables.add');
    }

    // Show Main tables view
    public function view(){
        if (Auth::guest()){
            return redirect('login');
        }
        return view('tables.index',[
            'tables' => Tables::all()
        ]);
    }
}
