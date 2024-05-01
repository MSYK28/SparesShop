<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use HasFactory;

    protected $table = 'fratij_sales';

    protected $fillable = [
        'sale_code',
        'customer_id',
        'total',
        'saleType',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }
}
