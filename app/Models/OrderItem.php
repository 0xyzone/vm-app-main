<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
