<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    protected $table = 'fratij_order_details';

    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
        'quantity_received',
        'total',
    ];

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
