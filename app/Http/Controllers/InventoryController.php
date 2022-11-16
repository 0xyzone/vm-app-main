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
    public function category_store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('categories', 'name')],
            'type' => ['required'],
        ]);

        //create  category
        Categories::create($formFields);

        return redirect('/inventory')->with('success', 'Category created sucessfully');
    }

    //create an item
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('items', 'name')],
            'price' => ['required'],
            'unit' => ['required'],
            'category' => ['required']
        ]);

        if ($request->hasFile('image')) {
            $formFields['image'] = $request->file('image')->store('images', 'public');
        }

        //create item
        Items::create($formFields);

        return redirect('/inventory')->with('success', 'Item created sucessfully');
    }

    //catagory form
    public function categories()
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        return view('inventory.category');
    }

    //category edit
    public function category_edit(categories $category)
    {
        return view('inventory.category-edit', [
            'categories' => Categories::all(),
            'category' =>  $category,
        ]);
    }

    //update category
    public function category_update(Request $request, Categories $category)
    {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('categories', 'name')->ignore($category->id)],
            'type' => ['required'],
        ]);

        $category->update($formFields);

        return redirect('/inventory')->with('success', 'Category updated successfully.');
    }

    //Inventory main view 
    public function view()
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        return view('inventory.index', [
            'categories' => Categories::orderByDesc('id')->paginate(3, ['*'], 'categories'),
            'all_cat' => Categories::all(),
            'items' => Items::orderByDesc('id')->paginate(3, ['*'], 'items'),
        ]);
    }

    //Item form
    public function item()
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        return view('inventory.item', [
            'categories' => Categories::all()
        ]);
    }

    //edit item
    public function item_edit(items $item)
    {
        return view('inventory.item-edit', [
            'categories' => Categories::all(),
            'item' =>  $item,
        ]);
    }

    //delete item
    public function item_delete(items $item)
    {
        Storage::delete('public/' . $item->image);
        $item->delete();

        return redirect('/inventory')->with('success', 'Item deleted successfully.');
    }

    //update item
    public function item_update(Request $request, Items $item)
    {
        $formFields = $request->validate([
            'name' => ['required', Rule::unique('items', 'name')->ignore($item->id)],
            'price' => ['required'],
            'unit' => ['required'],
            'category' => ['required'],
        ]);
        if ($request->hasFile('image')) {
            Storage::delete('public/' . $item->image);
            $item->image = $request->file('image')->store('images', 'public');
            $formFields['image'] = $item->image;
        }
        // Update item
        $item->update($formFields);
        return redirect('/inventory')->with('success', 'Item updated successfully.');
    }

    // Search Item
    public function search(Request $request)
    {
        $items = Items::where('name', 'Like', '%' . $request->search . '%')->orWhere('id', 'Like', '%' . $request->search . '%')->paginate(8, ['*'], 'items');
        $output = '';
        $output.='';
        foreach ($items as $item) {
            $output .=
                '
                    <div class="bg-gray-200 rounded-lg flex p-4 justify-between items-center">
                        <div class="text-black font-bold flex gap-2 items-center flex-shrink">
                            <div class="bg-gray-300 shadow-lg rounded-lg w-16 h-16 flex justify-center items-center flex-shrink-0">
                            #'. $item['id'] .'
                            </div>
                            <p class="font-thin truncate mr-1">
                            ' . $item["name"] . '
                            </p>
                        </div>
                        <p class="bg-amber-500 rounded-lg text-left flex-shrink-0 p-4 font-medium w-4/12">
                        Rs. ' . $item["price"] . '
                        </p>
                    </div>
                ';
        };
        return response($output);
    }
}
