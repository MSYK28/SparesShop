<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTransactions extends Model
{
    use HasFactory;

    protected $table = 'fratij_customer_transactions';

    protected $fillable = [
        'customer_id',
        'mpesa_code',
        'amount',
    ];

    public function customers()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }
}
