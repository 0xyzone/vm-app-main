<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'street',
        'country',
        'dob',
        'marriage',
        'marriagedate',
        'gender',
    ];

    public function visits(){
        $this->hasMany(Visit::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }
}
