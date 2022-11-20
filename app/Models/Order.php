<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'table',
        'customer',
        'item',
        'quantity',
        'status',
    ];

    public function orderItems(){
        return $this->belongsTo(OrderItem::class, 'order_id');
    }
}
