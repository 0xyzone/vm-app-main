<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Show index
    public function index()
    {
        if (Auth::guest()) {
            return redirect('login');
        }
        $date = Carbon::now();
        $day = date('Y-m-d', strtotime($date));
        $orders = Order::where('created_at', 'LIKE', '%' . $day . '%')->get();
        return view('reports.index', compact('orders'));
    }
}
