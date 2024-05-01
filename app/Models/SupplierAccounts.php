<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierAccounts extends Model
{
    use HasFactory;

    protected $table = 'fratij_supplier_accounts';

    protected $fillable = [
        'supplier_id',
        'transaction_id',
        'cheque_number',
        'transaction_type',
        'amount',
    ];

    public function supplier()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id', 'id');
    }
}
