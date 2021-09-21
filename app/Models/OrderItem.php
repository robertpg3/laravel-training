<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cost',
        'units',
        'order_id',
        'product_id',
    ];

    public function product()
    {
        return $this->hasOne('App\Models\Product');
    }
}
