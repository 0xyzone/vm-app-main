<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'unit',
        'category',
        'image',
    ];

    public function categories(){
        return $this->hasOne(Categories::class, 'id', 'category');
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
}
