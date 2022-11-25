<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'item_id',
        'qty',
        'type',
        'status'
    ];

    public function item(){
        return $this->belongsTo(Items::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
