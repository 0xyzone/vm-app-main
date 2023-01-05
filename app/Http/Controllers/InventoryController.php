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
        if (Auth::guest()) {
            return redirect('login');
        }
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
            'items' => Items::orderByDesc('id')->paginate(10, ['*'], 'items'),
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
        if (Auth::guest()) {
            return redirect('login');
        }
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
        $categories = Categories::all();
        $items = Items::where('name', 'Like', '%' . $request->search . '%')->orWhere('id', 'Like', '%' . $request->search . '%')->paginate(4, ['*'], 'items');
        $output = '';
        $output .= '';
        foreach ($items as $item) {
            foreach ($categories as $category) {
                if ($item['category'] == $category['id']) {
                    $type = $category['type'];
                    if ($type == "Food") {
                        $val = 1;
                    } else {
                        $val = 2;
                    }
                }
            }
            $output .=
                '
                <li>
                    <input type="radio" name="item" id="opt_' . $item['id'] . '" class="peer" hidden value="' . $item['id'] . '">
                    <input type="number" name="type" id="type_' . $item['id'] . '" value="' . $val . '" hidden>
                    <div class="rounded-lg flex p-4 justify-between items-center bg-gray-200 peer-checked:bg-amber-300" id="' . $item['id'] . '">
                        
                        <div class="text-black font-bold flex gap-2 items-center flex-shrink">
                            <div class="bg-gray-300 shadow-lg rounded-lg w-16 h-16 flex justify-center items-center flex-shrink-0">
                            #' . $item['id'] . '
                            </div>
                            <p class="font-bold mr-1">
                            ' . $item["name"] . '
                            <br><span class="font-normal">Rs. ' . $item["price"] . '</span>
                            </p>
                        </div>
                        <p class="bg-amber-500 rounded-lg flex-shrink-0 flex justify-center items-center font-medium w-8 h-8">
                            <i class="fa-solid fa-plus"></i>
                        </p>
                    </div>
                </li>
                <script>
                $("#' . $item['id'] . '").click(function(){
                    if($("#opt_' . $item['id'] . '").is(":checked")){
                    }else{
                        $("#opt_' . $item['id'] . '").prop("checked", true);
                    }
                });
                </script>
                ';
        };
        return response($output);
    }

    // Search Items
    public function searchItems(Request $request)
    {
        $categories = Categories::all();
        $items = Items::where('name', 'Like', '%' . $request->search . '%')->orWhere('id', 'Like', '%' . $request->search . '%')->paginate(4, ['*'], 'items');
        $output = '';
        $output .= '';
        foreach ($items as $item) {
            $output .=
                '<tr class="hover:bg-gray-200 odd:bg-gray-100 even:bg-gray-300">
                            <td class="user-td">' . $item['id'] . ' </td>
                            <td class="user-td">' . $item['name'] . '</td>
                            <td class="user-td">' . $item['price'] . '</td>
                            <td class="user-td hidden lg:inline-block">
                                ' . $item->categories->name . '
                            </td>
                            <td class="user-td">
                                <div class="flex gap-4 justify-center w-full">
                                    <a href="/inventory/items/' .$item->id .'/edit">
                                        <i class="fa-solid fa-edit hover:text-amber-600 hover:font-bold smooth"></i>
                                    </a>
                                    <a href="items/' . $item->id . '/delete" class=""
                                        onclick="return confirm("Are you sure you want to delete this item?.)">
                                        <i class="fa-regular fa-trash smooth hover:text-rose-600"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>';
        }
        return response($output);
    }
}
