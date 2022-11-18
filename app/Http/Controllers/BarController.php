<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarController extends Controller
{
    /// View index
    public function index(){
        if(Auth::guest()){
            return redirect('/login');
        } else {
            return view('bar.index', [
                'title' => 'Bar',
                'orderItems' => OrderItem::all(),
                'pendings' => OrderItem::where('status', 'pending')->where('type', 2)->paginate(5, ['*'], 'pendings'),
                'cookings' => OrderItem::where('status', 'cooking')->where('type', 2)->paginate(5, ['*'], 'cookings'),
                'dones' => OrderItem::where('status', 'done')->where('type', 2)->paginate(5, ['*'], 'dones'),
                'items' => Items::all()
            ]);
        };
    }

    public function update_item(Request $request, OrderItem $id){
        $formFields['status'] = $request['status'];
        $id->update($formFields);
        return redirect('/bar')->with('success', 'Item updated successfully.');
    }
}
