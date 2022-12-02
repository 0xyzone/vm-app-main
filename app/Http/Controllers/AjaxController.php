<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    // Call all pending orderitems
    public function new()
    {
        $pendings = OrderItem::where('status', 'pending')->where('type', 1)->paginate(5, ['*'], 'pendings');
        $output = "";
        foreach ($pendings as $var) {
            $output .= '    
            <div class="rounded-lg flex p-4 items-center bg-gray-200 justify-between">
                <div class="flex gap-2 items-center">
                    <div class="w-10 h-10 rounded-lg bg-gray-300 flex justify-center items-center">
                        ' . $var->items->id . '
                    </div>
                    <div class="grid grid-cols-2 border-separate gap-2">
                        <div class="flex flex-col">
                            <p class="font-bold">Order # ' . $var->order_id . '</p>
                            <p class="">' . $var->items->name . '</p>
                        </div>
                        <div class="flex flex-col pl-2">
                            <p class="font-bold">Qty.</p>
                            <p class="font-normal">' . $var->qty . '</p>
                        </div>
                    </div>
                </div>
                <form action="/orderitems/' . $var->id . '/update" method="post">
                    @csrf
                    @method("PUT")
                    <input type="text" name="status" id="status" value="cooking" hidden>
                    <button type="submit"
                        class="py-2 px-4 rounded-lg text-white hover:bg-amber-500 hover:text-gray-200 smooth text-xl bg-amber-600">Start</button>
                </form>
            </div>';
        }
        return response($output);
    }

    // Search Users
    public function search(Request $request, $param)
    {
        if ($param === 'users') {
            $search = User::where('id', 'Like', '%' . $request->search . '%')->orWhere('name', 'Like', '%' . $request->search . '%')->paginate(5);
        }
        if ($param === 'customers') {
            $search = Customer::where('id', 'Like', '%' . $request->search . '%')->orWhere('name', 'Like', '%' . $request->search . '%')->paginate(5);
        }
        $output = "";
        foreach ($search as $result) {
            $output .= '
                <li class="search-result justify-between" id="result' . $result->id . '">
                    <div class="flex gap-2">
                        <span class="w-6 text-right">
                        ' . $result->id . '
                        </span>
                        <span class="font-bold">
                        ' . $result->name . '
                        </span>
                    </div>
                </li>
                ';
            if ($param === 'users') {
                $output .= '
                    <script>
                    $("#result' . $result->id . '").click(function(){
                        location.href = "/users/' . $result->id . '/edit";
                    })
                    </script>
                    ';
            }
            if ($param === 'customers') {
                $output .= '
                <script>
                $("#result' . $result->id . '").click(function(){
                    location.href = "/customers/' . $result->id . '";
                })
                </script>
                ';
            }
        }

        return response($output);
    }

    // Search orders
    public function searchOrder(Request $request)
    {
        $search = Order::where('id', 'Like', '%' . $request->search . '%')->paginate(5);
        $output = "";
        foreach ($search as $result) {
            $output .= '
                <li class="search-result justify-between" id="result' . $result->id . '">
                    <div class="flex gap-2 px-4">
                        <span class=""> Order #</span>
                        <span class="font-bold">
                        ' . $result->id . '
                        </span>
                    </div>
                </li>
                <script>
                $("#result' . $result->id . '").click(function(){
                    location.href = "/orders/' . $result->id . '/additems"
                })
                </script>
                ';
        }

        return response($output);
    }

    // Search invoices
    public function searchInvoice(Request $request)
    {
        $search = Order::where('id', 'Like', '%' . $request->search . '%')->paginate(5);
        $output = "";
        foreach ($search as $result) {
            $output .= '
                <li class="search-result justify-between" id="result' . $result->id . '">
                    <div class="flex gap-2 px-4">
                        <span class=""> Order #</span>
                        <span class="font-bold">
                        ' . $result->id . '
                        </span>
                    </div>
                </li>
                <script>
                $("#result' . $result->id . '").click(function(){
                    location.href = "/invoices/' . $result->id . '"
                })
                </script>
                ';
        }

        return response($output);
    }
}
