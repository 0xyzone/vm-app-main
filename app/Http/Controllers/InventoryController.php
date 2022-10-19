<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    //Create a catagory
    public function category_store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('categories', 'name')],
            'type' => ['required'],
        ]);

        //create  category
        Categories::create($formFields);

        return redirect('/ctmgmt')->with('success', 'Category created sucessfully');
    }

     //create an item
     public function item_store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('items', 'name')],
            'price' => ['required'],
            'unit' => ['required'],
            'category' => ['required'],
        ]);

        //create item
        Items::create($formFields);

        return redirect('/itmgmt')->with('success', 'Item created sucessfully');
    }

    //catagory form
    public function categories(){
        if (Auth::guest()){
            return redirect('login');
        }
        return view('inventory.category');
    }

    //Inventory main view 
    public function view(){
        if (Auth::guest()){
            return redirect('login');
        }
        return view('inventory.index',[
            'categories' => Categories::all(),
            'items' => Items::all()
        ]);
        
    }

    //Item form
    public function item(){
        if (Auth::guest()){
            return redirect('login');
        }
        return view('inventory.item', [
            'categories' => Categories::all()
        ]);
    }
}
