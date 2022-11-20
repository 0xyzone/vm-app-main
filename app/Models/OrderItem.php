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

    public function items(){
        return $this->hasOne(Items::class, 'id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'id');
    }
}
