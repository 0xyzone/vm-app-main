<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Order $id)
    {
        $formFields = $request->validate([
            'item' => 'required',
            'qty' => 'required',
        ]);
        // Add items to database
        $formFields['order_id'] = $request['order_no'];
        $formFields['item_id'] = $request['item'];
        $formFields['status'] = $request['status'];
        $formFields['type'] = $request['type'];
        $formFields['qty'] = $request['qty'];
        if($id->payment == "Paid"){
            $id->update(['payment' => null]);
        }
        
        OrderItem::create($formFields);
        return redirect('/orders/'.$id->id.'/additems')->with('success', 'Item added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $order_no)
    {
        $orderItem = OrderItem::find($order_no);
        $id = $orderItem['order_id'];
        $formFields = $request->validate([
            'qty' => 'required'
        ]);
        //
        $orderItem->update($formFields);
        return redirect('/orders/'.$id.'/additems')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Upadte itmes
    public function update_item(Request $request, OrderItem $id){
        $formFields['status'] = $request['status'];
        $id->update($formFields);
        return redirect('/kitchen')->with('success', 'Item updated successfully.');
    }

    // Delete Items
    public function delete_item(Order $order, OrderItem $item){
        $item->delete();

        return redirect('/orders/'.$order->id.'/additems')->with('success', 'Item deleted successfully!');
    }
}
