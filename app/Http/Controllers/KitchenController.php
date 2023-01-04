<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Tables;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KitchenController extends Controller
{
    // View index
    public function index()
    {
        if (Auth::guest()) {
            return redirect('/login');
        } else {
            return view('kitchen.index', [
                'title' => 'Kitchen',
                'orderItems' => OrderItem::all(),
                'pendings' => OrderItem::where('status', 'pending')->where('type', 1)->paginate(5, ['*'], 'pendings'),
                'cookings' => OrderItem::where('status', 'cooking')->where('type', 1)->paginate(5, ['*'], 'cookings'),
                'dones' => OrderItem::where('status', 'done')->where('type', 1)->paginate(5, ['*'], 'dones'),
                'items' => Items::all(),
                'tables' => Tables::all()
            ]);
        };
    }
}
