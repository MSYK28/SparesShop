<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDetails extends Model
{
    use HasFactory;

    protected $table = 'fratij_sales_details';

    protected $fillable = [
        'sale_id',
        'product_id',
        'price',
        'quantity',
        'total',
    ];

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
