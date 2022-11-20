<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    // Call all pending orderitems
    public function new(){
        $pendings = OrderItem::where('status', 'pending')->where('type', 1)->paginate(5, ['*'], 'pendings');
        $output = "";
        foreach ($pendings as $var){
            $output.='    
            <div class="rounded-lg flex p-4 items-center bg-gray-200 justify-between">
                <div class="flex gap-2 items-center">
                    <div class="w-10 h-10 rounded-lg bg-gray-300 flex justify-center items-center">
                        '. $var->items->id .'
                    </div>
                    <div class="grid grid-cols-2 border-separate gap-2">
                        <div class="flex flex-col">
                            <p class="font-bold">Order # '. $var->order_id .'</p>
                            <p class="">'. $var->items->name .'</p>
                        </div>
                        <div class="flex flex-col pl-2">
                            <p class="font-bold">Qty.</p>
                            <p class="font-normal">'. $var->qty .'</p>
                        </div>
                    </div>
                </div>
                <form action="/orderitems/'. $var->id .'/update" method="post">
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
}
