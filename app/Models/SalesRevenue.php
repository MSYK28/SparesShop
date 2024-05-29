<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesRevenue extends Model
{
    use HasFactory;

    protected $table = 'fratij_sales_revenue';

    protected $fillable = [
        'sale_id',
        'customer_id',
        'product_id',
        'amount',
        'saleType',
    ];
}
