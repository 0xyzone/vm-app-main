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
        'discount',
        'status',
        'payment',
        'amount',
    ];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public function customers(){
        return $this->belongsTo(Customer::class);
    }
}
