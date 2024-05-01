<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'fratij_orders';

    protected $fillable = [
        'supplier_id',
        'orderCode',
        'total',
        'status',
    ];

    public function suppliers()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id', 'id');
    }
}
