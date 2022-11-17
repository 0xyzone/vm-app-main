<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KitchenController extends Controller
{
    // View index
    public function index(){
        if(Auth::guest()){
            return redirect('/login');
        } else {
            return view('kitchen.index', [
                'title' => 'Kitchen',
                'orderItems' => OrderItem::paginate(5),
                'items' => Items::all()
            ]);
        };
    }
}
