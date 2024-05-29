<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'fratij_products';

    protected $fillable =[
        'supplier_id',
        'productTitle',
        'productBarcode',
        'quantity',
        'reorderQty',
        'productPrice',
        'productBuyingPrice',
        'productDiscountedPrice',
    ];

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id', 'id');
    }
}
