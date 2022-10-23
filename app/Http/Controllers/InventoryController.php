<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
     public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('items', 'name')],
            'price' => ['required'],
            'unit' => ['required'],
            'category' => ['required']
        ]);

        if($request->hasFile('image')){
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

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

     //category edit
     public function category_edit(categories $category){
        return view('inventory.category-edit', [
            'categories' => Categories::all(),
            'category' =>  $category,
        ]);
    }

    //update category
    public function category_update(Request $request, Categories $category){
        $formFields = $request->validate([
            'name' => ['required'],
            'type' => ['required'],
        ]);
        
        $category->update($formFields);

        return redirect('/imgmt')->with('success', 'Category updated successfully.');
    }

    //Inventory main view 
    public function view(){
        if (Auth::guest()){
            return redirect('login');
        }
        return view('inventory.index',[
            'categories' => Categories::latest()->paginate(1),
            'items' => Items::latest()->Paginate(2),
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

    //edit item
    public function item_edit(items $item){
        return view('inventory.item-edit', [
            'categories' => Categories::all(),
            'item' =>  $item,
        ]);
    }

    //ddelete item
    public function item_delete(items $item){
        Storage::delete('public/'.$item->image);
        $item->delete();

        return redirect('/imgmt')->with('success', 'Item deleted successfully.');
    }

    //update item
    public function item_update(Request $request, Items $item){
        $formFields = $request->validate([
            'name' => ['required'],
            'price' => ['required'],
            'unit' => ['required'],
            'category' => ['required'],
        ]);
        if($request->hasFile('image')){
            Storage::delete('public/'.$item->image);
            $item->image = $request->file('image')->store('images', 'public');
            $formFields['image'] = $item->image;
        }
    // Update item
     $item->update($formFields);
     return redirect('/imgmt')->with('success', 'Item updated successfully.');
    }
}
