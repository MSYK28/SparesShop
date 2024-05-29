<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;

    protected $table = 'fratij_suppliers';

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'taxID',
        'bank',
        'bank_name',
        'bank_account',
        'status',
    ];

    public function products ()
    {
        return $this->hasMany(Products::class);
    }
}
